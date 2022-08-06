<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Common\CommonSettingController;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Storage;

use App\Models\Ticket;
use App\Models\Ticket_message;
use App\Models\Note;
use App\Models\Ticketassign;
use App\Models\Ticket_attachement as Attachments;
use App\Models\Statusmange;

use App\Notifications\Other as Other;
use App\Models\Admin;
use App\Models\User;
use App\Models\Role;
use DB;
use Auth;

use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class TicketController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin.auth:admin');
        $this->middleware('master');
        $this->middleware('masteraccess:Admin.TicketController');
        $this->per_page = empty(config('settings.config_pagination')) ? 10 : config('settings.config_pagination');
        $this->checkRole = Role::where('name','Administrator')->select('id')->first();
    }

    /**
     * Show the Admin dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    protected function index(Request $request){

        $status = false;
        if(!empty($this->checkRole) && $this->checkRole['id'] != auth()->guard('admin')->user()->role->role_id) {
            $status = true;
        } else {
            $status = false;
        }

        if(!empty($request->get('status'))) {
            $type = $request->get('status');
        } else {
            $type = 0;
        }

        if(!empty($request->get('agent'))) {
            $agent = $request->get('agent');
        } else {
            $agent = 0;
        }

        if(!empty($request->get('team'))) {
            $team = $request->get('team');
        } else {
            $team = 0;
        }

        if(!empty($request->get('client'))) {
            $client = $request->get('client');
        } else {
            $client = 0;
        }

        if(!empty($request->get('page'))) {
            $page = $request->get('page');
        } else {
            $page = 1;
        }

        $filter_data = [
            'type' => $type,
            'agent' => $agent,
            'client' => $client,
            'team' => $team,
            'is_admin' => auth()->guard('admin')->user()->role->role_id,
            'page' => $page,
        ];

        $allstatus = $this->getTicketStatusWise($filter_data);
        $filter_status = $this->getFilterTicketStatus($filter_data);
        
        $data = [
            'result'    =>  $allstatus,
            'filter_status' => $filter_status,
            'status'    =>  $status
        ];
        
        return view('admin.pages.support.ticket',compact('data'));
    }

    private function getTicketStatusWise($data = array()) {
        try {
            DB::statement("SET SQL_MODE=''");//this is the trick use it just before your query
            if(!empty($this->checkRole) && $this->checkRole['id'] != $data['is_admin']) {

                $sql = "SELECT `ts`.*, `ts`.admin_read_status, count(`ts`.id) as count, `adm`.id as agent_id, `adm`.name as agent,`adm`.profile as agent_profile, `user`.name as customer_name FROM `ticketassigns` tas 
                        LEFT JOIN `tickets` ts ON (`ts`.id = `tas`.ticket_id)
                        LEFT JOIN `admins` adm ON (`adm`.id = `tas`.user_id)
                        LEFT JOIN `users` user ON (`user`.id = `ts`.user_id)
                        LEFT JOIN `ticket_messages` tm ON (`tm`.ticket_id = `ts`.id)
                        LEFT JOIN `statusmanages` sm ON (`sm`.id = `ts`.status) WHERE `tas`.user_id = '".(int)Auth::guard('admin')->user()->id."'";

                // if(isset($data['agent']) && $data['agent']) {                    
                //     $sql.= "LEFT JOIN `ticketassigns` ts ON(ts.ticket_id = tc.id)";
                // }

                if(isset($data['type']) && $data['type'] == 0) {                    
                    $sql.=" AND `ts`.status != '".config('settings.ticket_module_open_status')."' ";
                } else {
                    $sql.=" AND `ts`.status = '".(int) $data['type']."' ";
                }

                if(isset($data['client']) && $data['client']) {                    
                    $sql.=" AND `ts`.user_id = '".(int) $data['client']."' ";
                }
                // if(isset($data['agent']) && $data['agent']) { 
                //     $sql.=" AND `ts`.user_id = '".(int) $data['agent']."' ";
                // }

                $sql.="GROUP BY `ts`.id ORDER BY ts.updated_at DESC";
                
            } else {
                $sql = "SELECT `tc`.*,`tc`.admin_read_status FROM `tickets` tc 
                    LEFT JOIN `statusmanages` sm ON (sm.id = tc.status) 
                    LEFT JOIN `ticket_messages` tm ON (`tm`.ticket_id = `tc`.id)
                    ";

                if(isset($data['agent']) && $data['agent']) {                    
                    $sql.= "LEFT JOIN `ticketassigns` ts ON(ts.ticket_id = tc.id)";
                }

                if(isset($data['type']) && $data['type'] == 0) {                    
                    $sql.=" WHERE `tc`.status != '".config('settings.ticket_module_open_status')."' ";
                } else {
                    $sql.=" WHERE `tc`.status = '".(int) $data['type']."' ";
                }

                if(isset($data['client']) && $data['client']) {                    
                    $sql.=" AND `tc`.user_id = '".(int) $data['client']."' ";
                }
                if(isset($data['agent']) && $data['agent']) { 
                    $sql.=" AND `ts`.user_id = '".(int) $data['agent']."' ";
                }

                $sql.="GROUP BY `tc`.id ORDER BY `tc`.updated_at  DESC";
                            
            }
            $page = !empty($data['page']) ? $data['page'] : 1 ;
            $size = $this->per_page;
                
            $query = DB::SELECT($sql);
            $collect = collect($query);

            $paginationData = new LengthAwarePaginator(
                                $collect->forPage($page, $size),
                                $collect->count(), 
                                $size, 
                                $page,
                                ['path' => '/admin/ticket/lists']
                            );
            return $paginationData;
        } catch (\Exception $e) {
            
            abort(500);
        }   
    }

    private function getFilterTicketStatus($data = array()){
        $statusArray = (new CommonSettingController)->getStatus();
        $makeArray = [];
        if(count($statusArray) > 0 ) {
            if(!empty($this->checkRole) && $this->checkRole['id'] != auth()->guard('admin')->user()->role->role_id) {
                $count = DB::table('ticketassigns')
                    ->join('tickets','tickets.id','ticketassigns.ticket_id')
                    ->where('ticketassigns.user_id',Auth::guard('admin')->user()->id)
                    ->count();
            } else {
                $count = Ticket::count(); //admin
            }
            $makeArray[] = [
                'is_selected' => false,
                'active'=>'',
                'status' => 'ALL',
                'count' => $count,
                'status_id' => 0,
            ];
            foreach ($statusArray as $key) {
                if(!empty($this->checkRole) && $this->checkRole['id'] != auth()->guard('admin')->user()->role->role_id) {
                    $count = DB::table('ticketassigns')
                        ->join('tickets','tickets.id','ticketassigns.ticket_id')                        
                        ->where('tickets.status',$key->id)
                        ->where('ticketassigns.user_id',Auth::guard('admin')->user()->id)
                        ->count();
                } else {
                    $count = Ticket::where('status',$key->id)->count(); //admin
                }

                if(!empty($data['type']) && $data['type'] == $key->id){
                    $active = 'uv-aside-active';
                } else {
                    $active = '';
                }
               
                if(!empty(json_decode(config('settings.ticket_module_select_ticket_status'),true)[$key->id])) {
                    $makeArray[] = [
                        'is_selected' => true,
                        'status' => $key->status_name,
                        'count' => $count,
                        'active'=> $active,
                        'status_id' => $key->id,

                    ];
                } else {
                    $makeArray[] = [
                        'is_selected' => false,
                        'status' => $key->status_name,
                        'count' => $count,
                        'active'=> $active,
                        'status_id' => $key->id,
                    ];
                }
            }
        }
        return $makeArray;
    }
  
    protected function supportTicketChatFunction($ticket,$client){
        $data['ticket'] = $ticket;
        $data['user'] = $client;
        $status = false;
        if(!empty($this->checkRole) && $this->checkRole['id'] != auth()->guard('admin')->user()->role->role_id) {
            $status = true;
        } else {
            $status = false;
        }
        $data['status'] = $status;
        $data['chats'] = $this->_getTicketChat($ticket,$client);
        if(!count($data['chats']))
            return redirect(route('admin.ticket'));   
        $data['moreticket'] = $this->_getTicketMore($ticket,$client);
        return view('admin.pages.support.ticketChat',compact('data'));
        
    }

    private function _getTicketMore($ticket,$client){
        
            if(!empty($this->checkRole) && $this->checkRole['id'] != auth()->guard('admin')->user()->role->role_id) {
                return DB::table('ticketassigns')
                    ->join('tickets','tickets.id','ticketassigns.ticket_id')
                    ->where('tickets.id','!=',$ticket)
                    ->where('tickets.user_id',$client)
                    ->where('ticketassigns.user_id',Auth::guard('admin')->user()->id)
                    ->count();
            } else {
                return Ticket::where('id','!=',$ticket)->where('user_id',$client)->count();
                // return DB::table('ticketassigns')
                //     ->join('tickets','tickets.id','ticketassigns.ticket_id')
                //     ->where('tickets.id',$ticket)
                //     ->where('tickets.user_id',$client)
                //     // ->where('ticketassigns.user_id',Auth::guard('admin')->user()->id)
                //     ->count();
            }
    }
    private function _getTicketChat($ticket,$client){
        try{
        $find = Ticket::find($ticket);
        $find->admin_read_status = 1;
        $find->save();
        if(!empty($this->checkRole) && $this->checkRole['id'] != auth()->guard('admin')->user()->role->role_id) {
            $assignCheck = Ticketassign::where('user_id',Auth::guard('admin')->user()->id)->where('ticket_id',$ticket)->exists();
                if($assignCheck) {
                    return Ticket::where('id',$ticket)->where('user_id',$client)->get();
                } else {
                    abort(403, 'Warning: you don\'t have access this page');
                }
        } else {
            return Ticket::where('id',$ticket)->where('user_id',$client)->get();
        }

    } catch (\Exception $e) {
        abort(500);
    }
            
    }
    protected function supportRequestReplyFunction(Request $req) {
        $this->modification('Admin.TicketController');
        $messages = [
            'required'=>'The :attribute field is required'
        ];

        $Validator = Validator::make(

            $req->only('ticket','editordata','user','attchements','note_submit'),
            
            [
                'user' =>'required|numeric|exists:users,id',
                'ticket' =>'required|numeric|exists:tickets,id',
                'editordata' =>'required',
                'note_submit' => 'required',
                // 'attchements.*'=> 'file|mimes:png,jpg,jpeg,xlsx,xls,docx,doc,ppt,pdf,txt,ods|max:13548'//dimensions:min_width=825,min_height=550
            ],
            $messages
        );

        if($Validator->fails()){
            $Response =$Validator->messages();
            return redirect(url()->previous())->withErrors($Response)->withInput();   
        }
        else{
            try{
                $ticket= new Ticket_message([
                    'ticket_id' => $req->get('ticket'),
                    'user_id' => Auth::guard('admin')->user()->id,
                    'r_msg' => $req->get('editordata'),
                    'from' => '0',
                    'to' => $req->get('user'),
                ]);

                $ticket->save();
                if(config('settings.ticket_module_note_status') == $req->get('note_submit')) {
                    $note= new Note([
                        'user_id' => 0,
                        'notes_added_name' => 'System',
                        'ticket_msg_id' => $ticket->id,
                        'notes' => 'Agent '.Auth::guard('admin')->user()->name.' updated status from Answered to Open',
                    ]);

                    $note->save();
                }
                $ticket_update = Ticket::find($req->get('ticket'));
                $ticket_update->status = $req->get('note_submit');  
                $ticket_update->user_read_status = 0;                  
                $ticket_update->save();

                $images = [];
                if(!empty($req->file('file'))) {
                    for($i = 0; $i < count($req->file('file')); $i++){
                        $images[] = [
                            'ticket_msg_id'=>$ticket->id,
                            'attachments'=>$req->file('file')[$i]->store('public/attachements/'.$ticket->id.''),
                            
                        ];
                    }

                    Attachments::insert($images);
                }
                
                $mailData = [
                    'user_id'=>$req->get('user'),
                    'subject'=>Ticket::where('id',$req->get('ticket'))->select('subject')->first()['subject'],
                    'message'=>$req->get('editordata'),
                    'attachments' => $images,
                    'ticket_id' => $req->get('ticket'),
                ];
                $userEmail = User::where('id',$req->get('user'))->select('email')->first()['email'];
                // event(new \App\Events\Specificuser(['subject'=>$mailData['subject'],'msg'=>'Support team replied on ticket #'.$req->get('ticket')],$req->get('user')));
                // $user = $this->_userNotify($req->get('user'));
                // $user->notify(new Other('Support team replied on your ticket #'.$req->get('ticket'),'fast-forward',route('home.support.ticket',['ticket'=>$req->get('ticket')]))); 
                // if(env('MAIL_FROM_ADDRESS'))
                //     \Mail::to(env('MAIL_FROM_ADDRESS'))->send(new \App\Mail\Admin($mailData));
                
                \Mail::to($userEmail)->send(new \App\Mail\User($mailData));

                $Response =['success_message'=>'Replied successfully.','alert'=>'alert-fill-warning'];
                return redirect(url()->previous())->withErrors($Response)->withInput();   
                // return redirect(route('admin.ticket.view',['ticket'=>$req->get('ticket'),'client'=>$req->get('user')]));   
            } catch (\Exception $e) {
                
                $Response =['error_message'=>$e->getMessage(),'alert'=>'alert-fill-warning'];
                return redirect(url()->previous())->withErrors($Response)->withInput();   
            }
        }
    }

    protected function noteAddOnTicket(Request $req){
        $this->modification('Admin.TicketController');
        $messages = [
            'required'=>'The :attribute field is required'
        ];

        $Validator = Validator::make(

            $req->only('ticket','note','user','note_submit'),
            
            [
                'user' =>'required|numeric|exists:users,id',
                'ticket' =>'required|numeric|exists:tickets,id',
                'note' =>'required',
                'note_submit' => 'nullable',
            ],
            $messages
        );

        if($Validator->fails()){
            $Response =$Validator->messages();
            return redirect(url()->previous())->withErrors($Response)->withInput();   
        }
        else{
            try{

                    $getId = Ticket_message::where('ticket_id',$req->get('ticket'))->select('id')->orderBy('id','desc')->first();                
                    $note= new Note([
                        'user_id' => Auth::guard('admin')->user()->id,
                        'notes_added_name' => Auth::guard('admin')->user()->name,
                        'ticket_msg_id' => $getId['id'],
                        'notes' => $req->get('note'),
                    ]);                    
                    $note->save();
                    $ticket_update = Ticket::find($req->get('ticket'));
                    $ticket_update->status = $req->get('note_submit');                    
                    $ticket_update->save();
                    if(config('settings.ticket_module_note_status') == $req->get('note_submit')) {
                        $note= new Note([
                            'user_id' => Auth::guard('admin')->user()->id,
                            'notes_added_name' => 'System',
                            'ticket_msg_id' => $getId['id'],
                            'notes' => 'Agent '.Auth::guard('admin')->user()->name.' updated status from Answered to Open',
                        ]);
                        $note->save();
                    }
                    // $mailData = [
                    //     'user_id'=>Auth::user()->id,
                    //     'subject'=>$req->get('subject'),
                    //     'message'=>$req->get('editordata'),
                    //     'ticket_id' => $ticket->id,
                    //     'attachments' => $images,
                    // ];
    
                    // \Mail::to()->send(new \App\Mail\Admin($mailData));

                $Response =['success_message'=>'Replied successfully.','alert'=>'alert-fill-warning'];
                return redirect(url()->previous())->withErrors($Response)->withInput();   
                
            } catch (\Exception $e) {
                $Response =['error_message'=>$e->getMessage(),'alert'=>'alert-fill-warning'];
                return redirect(url()->previous())->withErrors($Response)->withInput();   
            }$user = $this->_userNotify($req->get('user'));
                
        }
    }

    protected function ticketUpdateFunction(Request $req){
        $this->modification('Admin.TicketController');
        $messages = [
            'required'=>'The :attribute field is required'
        ];

        $Validator = Validator::make(

            $req->only('status','priority','ticket','user'),
            
            [
                'user' =>'required|numeric|exists:users,id',
                'ticket' =>'required|numeric|exists:tickets,id',
                'status' => 'required|numeric',
                'priority' => 'required|in:0,1,2|numeric',
            ],
            $messages
        );

        if($Validator->fails()){
            $Response =$Validator->messages();
            return redirect(url()->previous())->withErrors($Response)->withInput();   
        }
        else{
            try{
                $ticket_update = Ticket::find($req->get('ticket'));
                $ticket_update->status = $req->get('status');
                $ticket_update->priority = $req->get('priority');
                $ticket_update->save();
                $subject = Ticket::where('id',$req->get('ticket'))->select('subject','user_id')->first();
                event(new \App\Events\Dashboard());
                // $user = $this->_userNotify($req->get('user'));
                // $user->notify(new Other('Support team replied on your ticket #'.$req->get('ticket'),'fast-forward',route('home.support.ticket',['ticket'=>$req->get('ticket')]))); 
                // event(new \App\Events\Specificuser(['subject'=>$subject['subject'],'msg'=>'Your ticket #'.$req->get('ticket').' updated'],$subject['user_id']));
                // notify()->success('Your ticket #'.$req->get('ticket').' updated');
                $out='';
                $out.='
                <table class="inner-body" align="center" width="570" cellpadding="0"cellspacing="0" role="presentation"style="box-sizing: border-box;font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\';position: relative;-premailer-cellpadding: 0;-premailer-cellspacing: 0;-premailer-width: 570px;border-radius: 2px;border-width: 1px;margin: 0 auto;padding: 0;width: 570px;">
                    <tr>
                    <td colspan="4">
                        <div><p>Hello,</p><p>We have noticed your ticket #<a href="'.route('home.support.ticket',['ticket'=>$req->get('ticket')]).'">'.$req->get('ticket').'</a> has been updated Now you can see your ticket query.</p><p>We thanks for your contribution.</p></div>
                    </td>
                    </tr>
                    <tr>
                        <th style="color: #888888; font-size: 16px; font-family: \'Work Sans\', Calibri, sans-serif; line-height: 24px;">#Ticket</th>
                        <th style="color: #888888; font-size: 16px; font-family: \'Work Sans\', Calibri, sans-serif; line-height: 24px;">Subject</th>
                        <th style="color: #888888; font-size: 16px; font-family: \'Work Sans\', Calibri, sans-serif; line-height: 24px;">Priority</th>
                        <th style="color: #888888; font-size: 16px; font-family: \'Work Sans\', Calibri, sans-serif; line-height: 24px;">Status</th>
                    </tr>
                    <tr><td colspan="4" style="border:1px solid #dde;"></td></tr>
                    <tr>
                        <td style="text-align:center;color: #888888; font-size: 16px; font-family: \'Work Sans\', Calibri, sans-serif; line-height: 24px;">'.$req->get('ticket').'</td>
                        <td style="text-align:center;color: #888888; font-size: 16px; font-family: \'Work Sans\', Calibri, sans-serif; line-height: 24px;">'.$subject['subject'].'</td>
                        <td style="text-align:center;color: #888888; font-size: 16px; font-family: \'Work Sans\', Calibri, sans-serif; line-height: 24px;">';
                        if($req->get('priority') == 0):
                        $out.='Normal';
                        elseif($req->get('priority') == 1): 
                        $out.='High';
                        elseif($req->get('priority') == 2):
                        $out.='Urgent';
                        endif;
                        $out.='</td>
                        <td style="text-align:center;color: #888888; font-size: 16px; font-family: \'Work Sans\', Calibri, sans-serif; line-height: 24px;">';
                        if(!$req->get('status')):
                        $out.='Open';
                        else:
                        $out.='Close';
                        endif;
                        $out.='</td>
                    </tr>
                    <tr>
                    <td colspan="4">
                        <div><p>Thanks &amp; Regards,</p><p>Support Team</p></div>
                    </td>
                    </tr>
                </table>
                ';
                $mailData = [
                    'user_id'=>$req->get('user'),
                    'subject'=>Ticket::where('id',$req->get('ticket'))->select('subject')->first()['subject'],
                    'message'=>$out,
                    'ticket_id' => $req->get('ticket'),
                ];
                $userEmail = User::where('id',$req->get('user'))->select('email')->first()['email'];

                \Mail::to($userEmail)->send(new \App\Mail\User($mailData));
                $Response =['success_message'=>'Changes saved successfully.','alert'=>'alert-fill-warning'];
                return redirect(url()->previous())->withErrors($Response)->withInput();   
                // return redirect(route('admin.ticket.view',['ticket'=>$req->get('ticket'),'client'=>$req->get('user')]));   
            } catch (\Exception $e) {
                $Response =['error_message'=>$e->getMessage(),'alert'=>'alert-fill-warning'];
                return redirect(url()->previous())->withErrors($Response)->withInput();   
            }
        }
    }

    protected function getRelatedTicket($ticket_id,$user){
        try{
            DB::statement("SET SQL_MODE=''");//this is the trick use it just before your query
            
            if(!empty($this->checkRole) && $this->checkRole['id'] != auth()->guard('admin')->user()->role->role_id) {
                $get = DB::table('tickets')
                                ->join('ticket_messages','ticket_messages.ticket_id','tickets.id')
                                ->join('ticketassigns','ticketassigns.ticket_id','tickets.id')
                                
                                ->join('admins','admins.id','ticketassigns.user_id')
                                ->join('statusmanages','statusmanages.id','tickets.status')
                                ->where('tickets.id','!=',$ticket_id)
                                ->where('tickets.user_id',$user)
                                ->where('ticketassigns.user_id',Auth::guard('admin')->user()->id)
                                // ->where('tickets.user_id',$user)
                                // ->where('ticket_messages.from','!=','0')
                                //->skip(1)
                                ->select('tickets.id as ticket_id','tickets.user_id','tickets.subject','tickets.message','tickets.status','tickets.priority','tickets.created_at as ticket_created','statusmanages.*','admins.id as agent_id','admins.name as agent_name','admins.profile as admin_profile','admins.id as admin_id',DB::raw("count(ticket_messages.id) as count"))
                                ->groupBY('tickets.id')
                                ->get();
                
            } else {
                    $get = DB::table('tickets')
                                ->join('ticket_messages','ticket_messages.ticket_id','tickets.id')
                                ->join('ticketassigns','ticketassigns.ticket_id','tickets.id')
                                ->join('admins','admins.id','ticketassigns.user_id')
                                ->join('statusmanages','statusmanages.id','tickets.status')
                                ->join('users','tickets.user_id','users.id')
                                ->where('tickets.id','!=',$ticket_id)
                                ->where('tickets.user_id',$user)
                                // ->where('ticketassigns.user_id',Auth::guard('admin')->user()->id)
                                // ->where('tickets.user_id',$user)
                                // ->where('ticket_messages.from','!=','0')
                                //->skip(1)
                                ->select('tickets.id as ticket_id','tickets.user_id','tickets.subject','tickets.message','tickets.status','tickets.priority','tickets.created_at as ticket_created','statusmanages.*','users.id as user_id','admins.id as agent_id','admins.name as agent_name','admins.profile as admin_profile','admins.id as admin_id',DB::raw("count(ticket_messages.id) as count"))
                                ->groupBY('tickets.id')
                                ->get();
                }

                $relatedData = [];
                if(!empty($get)) {
                    foreach ($get as $key => $value) {
                        if(!in_array($value->admin_profile,['0','1','2','3','4'])){
                            $path = asset('storage').'/profile/'.explode('/',$value->admin_profile)[2].'';
                        } else {
                            $path = asset('logo').'/'.$value->admin_profile.'.png';
                        }
                        $relatedData[] = [
                            'admin_id' => $value->admin_id,
                            'admin_profile' => $path,
                            'agent_name' => $value->agent_name,
                            'count' => $value->count,
                            'created_at' => $value->ticket_created,
                            'id' => $value->ticket_id,
                            'message' => '',
                            'priority' => $value->priority,
                            'status' => $value->status_name,
                            'subject' => $value->subject,
                            'updated_at' => $value->updated_at,
                            'agent_id' => $value->agent_id,
                            'user_id' => $value->user_id,

                        ];
                    }
                }

                
            $data = [
                'status'=>1,
                'data'=> $relatedData,
            ];
          
        } catch (\Exception $e) {
            $data = [
                'status'=>0,
                'message'=>$e->getMessage(),
            ];
        }
        
        return response()->json($data);
    }

    protected function autocompleteFunction(Request $request){
        $json = array();
        
		// if (isset($request->filter_name)) {
			$filter_data = array(
				'filter_name' => isset($request->filter_name) ? $request->filter_name : '',
				'sort'        => 'name',
				'order'       => 'ASC',
				'start'       => 0,
				'limit'       => 5
			);
            
			$results = $this->_getAssignName($filter_data);
            
            if(count($results) > 0) {
                foreach ($results as $result) {
                    $path = '';
                    if(!in_array($result->profile,['0','1','2','3','4'])){
                        $path = asset('storage').'/profile/'.explode('/',$result->profile)[2];
                    } else {
                        $path =  asset('logo').'/'.$result->profile.'.png';
                    }                                                
                    $json[] = array(
                        'user_id' => $result->id,
                        'name'        => $result->name,
                        'email' => $result->email,
                        'image' => $path
                    );
                }
            // }
		}

		$sort_order = array();

		foreach ($json as $key => $value) {
			$sort_order[$key] = $value['name'];
		}

		array_multisort($sort_order, SORT_ASC, $json);
        return response()->json($json,200);
    }

    private function _getAssignName($data = array()){
        $sql = "SELECT `name`,`id`,`email`,`profile` From admins";
		if (!empty($data['filter_name'])) {
			$sql .= " WHERE name LIKE '" . $data['filter_name'] . "%'";
		}
		
        $sort_data = array(
			'name',
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}
        
		$query = DB::SELECT($sql);

		return $query;
    }

    protected function changeAssigneeFunction(Request $req) {
        $this->modification('Admin.TicketController');
        $messages = [
            'required'=>'The :attribute field is required'
        ];

        $Validator = Validator::make(

            $req->only('selected','assignee_row'),
            
            [
                'selected' =>'required|numeric|exists:tickets,id',
                'assignee_row' => 'required|numeric|exists:admins,id',                
            ],
            $messages
        );

        if($Validator->fails()){
            $Response = ['message'=>$Validator->messages(),'status'=>0];
        }
        else{
            try{
                if(!empty($req->get('selected'))) {
                    
                    $ticketAssigne = [];
                    $ticketNote = [];
                    // foreach ($req->get('selected') as $key) {
                        if(!Ticketassign::where('user_id',$req->get('assignee_row'))->where('ticket_id',$req->get('selected'))->exists()){
                            
                            $name = Admin::where('id',$req->get('assignee_row'))->select('name','email','id')->first();
                            $messageId = Ticket_message::where('ticket_id',$req->get('selected'))->select('id')->orderBy('id','desc')->first();
                            
                            $getUserId = Ticketassign::select('user_id')->where('ticket_id',$req->get('selected'))->first();
                            if(!empty($getUserId)):
                            $updateAfterNameChange = Admin::where('id',$getUserId['user_id'])->select('name')->first();
                            
                            Ticketassign::where('ticket_id',$req->get('selected'))->delete();
                            $ticketNote[] = [
                                'user_id' => 0,
                                'notes_added_name' => 'System',
                                'ticket_msg_id' => !empty($messageId->id) ? $messageId->id : $req->get('selected'),
                                'notes' => 'Ticket assigne change from '.$updateAfterNameChange['name'].' to '.$name['name'].'', 
                            ];
                        else:                            
                            $ticketNote[] = [
                                'user_id' => 0,
                                'notes_added_name' => 'System',
                                'ticket_msg_id' => !empty($messageId->id) ? $messageId->id : $req->get('selected'),
                                'notes' => 'Ticket assigne change from unassigned to '.$name['name'].'', 
                            ];
                        endif;
                            $mailData = [
                                'user_id'=>$name['id'],
                                'subject'=>Ticket::where('id',$req->get('selected'))->select('subject')->first()['subject'],
                                'message'=>'You have assigned new ticket <a href="/admin/ticket/view/"'.$req->get('selected').'/'.$name['id'].'>#'.$req->get('selected').'</a>',
                                'attachments' => [],
                                'ticket_id' => $req->get('selected'),
                            ];

                            $ticketAssigne[] = [
                                'ticket_id' => $req->get('selected'),
                                'user_id' => $req->get('assignee_row')
                            ];

                            \Mail::to($name['email'])->send(new \App\Mail\Admin($mailData));
                        }
                    // }
                    
                    Ticketassign::insert($ticketAssigne);
                    Note::insert($ticketNote);
                    
                    $Response = ['message'=>'Ticket assigned','status'=>1];
                    
                } else {
                    $Response = ['message'=>'Please select assignee records.','status'=>0];
                }
                
            } catch (\Exception $e) {
                $Response =['message'=>$e->getMessage(),'status'=>0];
            }
        }

        return response()->json($Response);
    }

    protected function getAssigneeListFunction($request){
        $html = "";     
        if(!empty($request)) {                   
            $data = []; //array get data;
            foreach(explode(',',$request) as $key){
                $data[] = $key;
            }
            // count data avialable or not;
            if(count($data) > 0) {
                $ticket = Ticket::whereIn('id',$data)->get();
                if(!empty($ticket)){
                    foreach ($ticket as $key => $value) {
                        $profile = Ticketassign::where('ticket_id',$value->id)->select('user_id')->get();
                        $html.='
                        <div class="uv-app-section">
                        <div class="uv-app-task-plank">
                            <div class="uv-app-task-section">
                                <span class="uv-app-task-text">
                                    <span class="uv-margin-right-5">
                                        <a href="#" target="_blank">#'.$value->id.'</a>
                                    </span>
                                    <a href="#" target="_blank">
                                        '.$value->subject.'
                                    </a>
                                </span>                                
                            </div>';
                            if(!empty($profile)) {
                    $html.='<div class="uv-app-task-section" data-index="agent">
                                <span class="uv-tag-info">Agent:</span>
                                <div class="row">
                                    <div class="d-flex">';                                    
                                        foreach($profile as $profiles){
                                            $user = Admin::where('id',$profiles->user_id)->select('profile','id','name')->first();
                                            if(!empty($user)) {
                                                $html.='<div class="uv-app-task-section new" title="'.$user->id.'|'.$value->id.'">';
                                                if(!in_array($user->profile,['0','1','2','3','4'])){
                                                    $html.='<img class="uv-agent-thumbnail new" id="uv-agent-thumbnail" src="'.asset("storage").'/profile/'.explode('/',$user->profile)[2].'" alt="'.$user->name.'">';
                                                } else {
                                                    $html.='<img class="uv-agent-thumbnail new" id="uv-agent-thumbnail" src="'.asset('logo').'/'.$user->profile.'.png" alt="'.$user->name.'">';
                                                }
                                                $html.='</div>';
                                            }
                                        }                                    
                                    $html.='</div>
                                </div>
                            </div>';
                        }
                        $html.='</div>
                    </div>
                        ';  
                    }
                } else {
                    $html.='
                        <div class="uv-app-section">
                            <div class="uv-app-task-plank">
                                <div class="uv-app-task-section">
                                    <span class="uv-app-task-text">
                                        <p class="uv-no-more uv-text-center">
                                            No Records Found!<br />
                                            Please select tickets then ticket assignes will show.
                                        </p>
                                    </span>                                
                                </div>
                            </div>
                        </div>';
                        
                }
                
            } else {
                $html.='
                        <div class="uv-app-section">
                            <div class="uv-app-task-plank">
                                <div class="uv-app-task-section">
                                    <span class="uv-app-task-text">
                                        <p class="uv-no-more uv-text-center">
                                            No Records Found!<br />
                                            Please select tickets then ticket assignes will show.
                                        </p>
                                    </span>                                
                                </div>
                            </div>
                        </div>';
            }            
        } else {
            $html.='
            <div class="uv-app-section">
                <div class="uv-app-task-plank">
                    <div class="uv-app-task-section">
                        <span class="uv-app-task-text">
                            <p class="uv-no-more uv-text-center">
                                No Records Found!<br />
                                Please select tickets then ticket assignes will show.
                            </p>
                        </span>                                
                    </div>
                </div>
            </div>';
        }

        return response()->json(['status'=>0,'html'=>$html]);
        
    }

    protected function removeAssigneesFunction($id) {
        try {
        if(Ticketassign::where('user_id',explode('|',$id)[0])->where('ticket_id',explode('|',$id)[1])->exists()){
            Ticketassign::where('user_id',explode('|',$id)[0])->where('ticket_id',explode('|',$id)[1])->delete();
            $data = ['error'=>'','message'=>'Assignee removed successfully'];
        } else {
            $data =  ['error'=>'error','message'=>'Assignee not found'];
            }
        } catch (\Exception $e) {
           $data = ['error'=>'error','message'=>$e->getMessage()];
        }
        return response()->json($data);
        
    }
    private function _userNotify($id){
        return User::find($id);
    }

    protected function modification($controller) {
        $roleCheck = Role::where('id',Auth::guard('admin')->user()->role->role_id)->select('permission')->first()['permission'];        
        if(strpos($controller,'.')) {
            $controller  = str_replace('.','/',$controller);
        }

        if(!empty($roleCheck) && $roleCheck != 'null' && !empty(json_decode($roleCheck,true)['modify']) && in_array($controller,json_decode($roleCheck,true)['modify'])) {
            return true;
        } else {
            return abort(403, 'Warning! You don\'t have modify permission');
        }   
    }
}
