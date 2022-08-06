<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Storage;

use App\Models\Ticket;
use App\Models\Ticket_message;
use App\Models\Ticketassign;
use App\Models\Note;
use App\Models\Ticket_attachement as Attachments;

use App\Notifications\Other as Other;
use App\Models\User;
use App\Models\Role;
use Auth;
use DB;

class TicketController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth' => 'verified']);
        $this->middleware('role');
        $this->middleware('access:User.TicketController');
        $this->per_page = empty(config('settings.config_pagination')) ? 10 : config('settings.config_pagination');
    }

    /**
     * Show the application Ticket.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    protected function supportForm() {
        $data = $this->_getTickets();
        return view('user.pages.support.supportlist',compact('data'));
    }
    
    private function _getTickets(){
        DB::statement("SET SQL_MODE=''");//this is the trick use it just before your query
        return Ticket::leftJoin('ticket_messages',function($join){
            $join->on('ticket_messages.ticket_id','=','tickets.id');  
        })->where('tickets.user_id',Auth::user()->id)->groupBy('tickets.id')->orderBy('tickets.updated_at','desc')->select('tickets.*')->paginate($this->per_page);
        
    }

    protected function supportFormAddTicket() {
        return view('user.pages.support.add_support');
    }

    protected function supportTicketChatFunction($ticket){
        $data['ticket'] = $ticket;
        $data['chats'] = $this->_getTicketChat($ticket);
        if(!count($data['chats']))
            return redirect(route('home.support.add'));   
        $data['moreticket'] = $this->_getTicketMore($ticket);
        return view('user.pages.support.ticket_chat',compact('data'));
        
    }

    private function _getTicketMore($ticket){
        return Ticket::where('id','!=',$ticket)->where('status','!=','0')->where('user_id',Auth::user()->id)->count();
    }
    
    private function _getTicketChat($ticket){
        try {
            $find = Ticket::find($ticket);
            $find->user_read_status = 1;
            $find->save();
            
            return Ticket::where('id',$ticket)->where('user_id',Auth::user()->id)->get();
        } catch (\Exception $e) {
            abort(500);
        }
    }

    protected function supportFormAddTicketRequest(Request $req){
        $this->modification('User.TicketController');
        $messages = [
            'required'=>'The :attribute field is required'
        ];

        $Validator = Validator::make(

            $req->only('subject','editordata'),
            [
                'subject' =>'required|max:80|string',
                'editordata' =>'required',
            ],
            $messages
        );

        if($Validator->fails()){
            $Response =$Validator->messages();
            return redirect(url()->previous())->withErrors($Response)->withInput();   
        }
        else{
            try{
                $checkRole = Role::where('name','Administrator')->select('id')->first();

                $ticket= new Ticket([
                    'user_id'=>Auth::user()->id,
                    'subject'=>$req->get('subject'),
                    'status'=>config('settings.ticket_module_default_status'),
                    'message'=>'',
                    'admin_read_status' => 0,                    
                ]);
                $ticket->save();

                $ticketConverstion= new Ticket_message([
                    'ticket_id' => $ticket->id,
                    'r_msg' => $req->get('editordata'),
                    'from' => Auth::user()->id,
                    'to' => '0',
                ]);
                $ticketConverstion->save();

                // $ticketAssign= new Ticketassign([
                //     'ticket_id' => $ticket->id,
                //     'user_id' => !empty($checkRole['id']) ? $checkRole['id'] : 0,                    
                // ]);

                // $ticketAssign->save();

                // $note= new Note([
                //     'user_id' => 0,
                //     'notes_added_name' => 'System',
                //     'ticket_msg_id' => $ticketConverstion->id,
                //     'notes' => 'Ticket assigned from customer to Administrator',
                // ]);

                // $note->save();

                $images = [];
                    if(!empty($req->file('file'))) {
                        for($i = 0; $i < count($req->file('file')); $i++){
                            $images[] = [
                                'ticket_msg_id'=>$ticketConverstion->id,
                                'attachments'=>$req->file('file')[$i]->store('public/attachements/'.$ticketConverstion->id.''),
                                
                            ];
                        }
                        Attachments::insert($images);
                    }

                $mailData = [
                    'user_id'=>Auth::user()->id,
                    'subject'=>$req->get('subject'),
                    'message'=>$req->get('editordata'),
                    'ticket_id' => $ticket->id,
                    'attachments' => $images,
                ];

                $recipients = env('MAIL_FROM_ADDRESS');
                event(new \App\Events\Dashboard());
                // Auth::user()->notify(new Other($req->get('subject').' Ticket addded','external-link',route('home.support.ticket',['ticket'=>$ticket->id]))); 
                // event(new \App\Events\Specificuser(['subject'=>$req->get('subject'),'msg'=>'Added a new ticket #'.$ticket->id],Auth::user()->id));
                // event(new \App\Events\Admin(['subject'=>$mailData['subject'],'msg'=>Auth::user()->name.' Added a new ticket #'.$ticket->id]));

                if(env('MAIL_FROM_ADDRESS'))
                    \Mail::to(env('MAIL_FROM_ADDRESS'))->send(new \App\Mail\Admin($mailData));
                
                \Mail::to(Auth::user()->email)->send(new \App\Mail\User($mailData));

                return redirect(route('home.support.ticket',['ticket'=>$ticket->id]));   
            } catch (\Exception $e) {
                $Response =['error_message'=>$e->getMessage(),'alert'=>'alert-fill-warning'];
                return redirect(url()->previous())->withErrors($Response)->withInput();   
            }
        }
    }

    protected function supportRequestReplyFunction(Request $req) {
        $this->modification('User.TicketController');
        $messages = [
            'required'=>'The :attribute field is required'
        ];

        $Validator = Validator::make(
            $req->only('ticket','editordata','attchements','note_submit'),
            [
                'ticket' =>'required|numeric|exists:tickets,id',
                'editordata' =>'required',
                'note_submit'   => 'nullable',
                // 'attchements.*'=> 'file|mimes:png,jpg,jpeg,xlsx,docx,ppt,pdf,txt|max:13548'//dimensions:min_width=825,min_height=550
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
                        'r_msg' => $req->get('editordata'),
                        'from' => Auth::user()->id,
                        'to' => '0',
                    ]);

                    $ticket->save();

                    $ticket_update = Ticket::find($req->get('ticket'));
                    $ticket_update->status = $req->get('note_submit');    
                    $ticket_update->admin_read_status = 0;                
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
                        'user_id'=>Auth::user()->id,
                        'subject'=>Ticket::where('id',$req->get('ticket'))->select('subject')->first()['subject'],
                        'message'=>$req->get('editordata'),
                        'ticket_id' => $ticket->id,
                        'attachments' => $images,
                        'msg' => 'Replied ticket #'.$ticket->id,
                    ];
                    // Auth::user()->notify(new Other('You have replied on ticket #'.$ticket->id,'fast-forward',route('home.support.ticket',['ticket'=>$ticket->id]))); 
                    // event(new \App\Events\Specificuser(['subject'=>$mailData['subject'],'msg'=>'You replied on ticket #'.$ticket->id],Auth::user()->id));
                    // event(new \App\Events\Admin(['subject'=>$mailData['subject'],'msg'=>Auth::user()->name.' replied on ticket #'.$ticket->id]));
                    
                    if(env('MAIL_FROM_ADDRESS'))
                        \Mail::to(env('MAIL_FROM_ADDRESS'))->send(new \App\Mail\Admin($mailData));
                    
                    // \Mail::to(Auth::user()->email)->send(new \App\Mail\User($mailData));
                    // notify()->success(Auth::user()->name.' replied on ticket #'.$ticket->id); 
                    $Response =['success_message'=>'Replied successfully.','alert'=>'alert-fill-warning'];
                    return redirect(url()->previous())->withErrors($Response)->withInput();   
                
            } catch (\Exception $e) {
                $Response =['error_message'=>$e->getMessage(),'alert'=>'alert-fill-warning'];
                return redirect(url()->previous())->withErrors($Response)->withInput();   
            }
        }
    }

    protected function access($path,$controller,$data = array()) {
        $roleCheck = Role::where('id',auth()->user()->role->role_id)->select('permission')->first()['permission'];        
        if(strpos($controller,'.')) {
            $controller  = str_replace('.','/',$controller);
        }
        if(!empty($roleCheck) && $roleCheck != 'null' && !empty(json_decode($roleCheck,true)['access']) &&  in_array($controller,json_decode($roleCheck,true)['access'])) {
            return view($path,$data);
        } else {
            abort(403, 'Warning! you don\'t have access');
        }   
    }

    protected function modification($controller) {
        $roleCheck = Role::where('id',auth()->user()->role->role_id)->select('permission')->first()['permission'];        
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
