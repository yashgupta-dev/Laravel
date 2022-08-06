<?php

namespace App\Http\Controllers\Admin\Chat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Storage;

use App\Notifications\Other as Other;
use App\Models\Admin;
use App\Models\User;
use App\Models\Role;
use Auth;

// message chat model
use App\Models\Inboxe;
use App\Models\Message;
use Artisan;

use DB;

class ChatBoatController extends Controller
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
        $this->middleware('masteraccess:Admin.Chat.ChatBoatController');
        $this->per_page = empty(config('settings.config_pagination')) ? 10 : config('settings.config_pagination');
        $this->checkRole = Role::where('name','Administrator')->select('id')->first();
    }

    /**
     * Show the Admin Profile.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        
        return view('admin.pages.chat.index');
    }

    /**
     * Return chat users list users
     * 
     */
    public function getChatList() {
        
        // try {
            if(!empty($this->checkRole) && $this->checkRole['id'] != auth()->guard('admin')->user()->role->role_id) {
                $userlist = Inboxe::leftJoin('admins',function($join){
                    $join->on('admins.id','=','inboxes.sender');
                })->leftJoin('admin_role',function($join){
                    $join->on('inboxes.sender','=','admin_role.user_id');
                })->leftJoin('roles',function($join){
                    $join->on('admin_role.role_id','=','roles.id');
                })->select('admins.name','admins.id','admins.email','admins.phone','admins.profile','roles.name as role_name')
                ->where('inboxes.receiver',Auth::guard('admin')->user()->id)->orderBy('inboxes.updated_at','desc')->get();

                // $userlist[] = Admin::leftJoin('admin_role',function($join){
                //     $join->on('admin_role.user_id','=','admins.id');
                // })->leftJoin('roles',function($join){
                //     $join->on('admin_role.role_id','=','roles.id');
                // })->select('admins.name','admins.id','admins.email','admins.phone','admins.profile','roles.name as role_name')->where('admin_role.role_id',Auth::guard('admin')->user()->role->role_id)->get();

                // print_r($userlist);
                $users = [];
                if(count($userlist) > 0) {
                    foreach ($userlist as $user) {
                        if(!in_array($user->profile,['0','1','2','3','4'])){
                            $path = asset('storage').'/profile/'.explode('/',$user->profile)[2].'';
                        } else {
                            $path = asset('logo').'/'.$user->profile.'.png';
                        }
                        $users[] = [
                            'name' => $user->name,
                            'email' => $user->email,
                            'phone' => $user->phone,
                            'profile' => $path,
                            'user_id'   => $user->id,
                            'role_name' => $user->role_name,
                            'last_message' => $this->_getLastMessage2($user->id)
                        ];
                    }
                }
                return response()->json($users,200);

            } else {
                $userlist = Admin::leftJoin('admin_role',function($join){
                    $join->on('admins.id','=','admin_role.user_id');
                })->leftJoin('roles',function($join){
                    $join->on('admin_role.role_id','=','roles.id');
                })->select('admins.name','admins.id','admins.email','admins.phone','admins.profile','roles.name as role_name')
                ->where('admins.id','!=',Auth::guard('admin')->user()->id)->get();                
                
                $users = [];
                if(count($userlist) > 0) {
                    foreach ($userlist as $user) {
                        if(!in_array($user->profile,['0','1','2','3','4'])){
                            $path = asset('storage').'/profile/'.explode('/',$user->profile)[2].'';
                        } else {
                            $path = asset('logo').'/'.$user->profile.'.png';
                        }
                        $users[] = [
                            'name' => $user->name,
                            'email' => $user->email,
                            'phone' => $user->phone,
                            'profile' => $path,
                            'user_id'   => $user->id,
                            'role_name' => $user->role_name,
                            'last_message' => $this->_getLastMessage($user->id)
                        ];
                    }
                }
                return response()->json($users,200);
            }
        // } catch (\Exception $e) {
            
        //     return response()->json($e->getMessage(),200);
        // }
    }

    protected function _getLastMessage($id) {
        try {
            $chatList = Inboxe::leftJoin('messages',function($join){
                $join->on('inboxes.id','=','messages.inbox_id');
            })->select('messages.*')->where(['inboxes.receiver'=>$id,'inboxes.sender'=>Auth::guard('admin')->user()->id])->orderBy('messages.id','desc')->first();

            $count = Inboxe::leftJoin('messages',function($join){
                $join->on('inboxes.id','=','messages.inbox_id');
            })->where(['inboxes.receiver'=>$id,'inboxes.sender'=>Auth::guard('admin')->user()->id,'admin_read_status'=>'0'])->orderBy('messages.id','desc')->count();
            

            if(!empty($chatList)) {
                if($chatList->msg_type == 1) {
                    $msg = 'Attachments';
                } else {
                    $msg = $chatList->msg;
                }
                return [
                    'last_msg'=>$msg,
                    'time'=>\Carbon\Carbon::parse($chatList->created_at)->diffForHumans(),
                    'status'=>1,
                    'unread1'=>$id,
                    'unread' => $count,
                ];
            } else {
                return ['status'=>0];
            }
        } catch (\Exception $e) {
            
            return ['status'=>0];
        }
    }

    protected function _getLastMessage2($id) {
        try {
            $chatList = Inboxe::leftJoin('messages',function($join){
                $join->on('inboxes.id','=','messages.inbox_id');
            })->select('messages.*')->where(['inboxes.sender'=>$id,'inboxes.receiver'=>Auth::guard('admin')->user()->id])->orderBy('messages.id','desc')->first();
            $count = Inboxe::leftJoin('messages',function($join){
                $join->on('inboxes.id','=','messages.inbox_id');
            })->where(['inboxes.sender'=>$id,'inboxes.receiver'=>Auth::guard('admin')->user()->id,'user_read_status'=>'0'])->orderBy('messages.id','desc')->count();
            
            if(!empty($chatList)) {
                if($chatList->msg_type == 1) {
                    $msg = 'Attachments';
                } else {
                    $msg = $chatList->msg;
                }
                return [
                    'last_msg'=>$msg,
                    'time'=>\Carbon\Carbon::parse($chatList->created_at)->diffForHumans(),
                    'status'=>1,
                    'unread2'=>$id,
                    'unread' => $count,
                ];
            } else {
                return ['status'=>0];
            }
        } catch (\Exception $e) {
            
            return ['status'=>0];
        }
    }

    protected function chatSendFunction (Request $req){
        $this->modification('Admin.Chat.ChatBoatController');
        $messages = [
            'required'=>'The :attribute field is required'
        ];

        $Validator = Validator::make(

            $req->only('chat_text','chat_sender_id','chat_reciver_id','files'),            
            [
                'chat_text' =>'required',
                'chat_sender_id' => 'required|numeric|exists:admins,id',
                'chat_reciver_id' => 'required|numeric|exists:admins,id',                
            ],
            $messages
        );

        if($Validator->fails()){
            $Response = $Validator->messages();
            // $Response = ['message'=>'Something went going wrong!','status'=>0];
        }
        else{
            try{
                if(!empty($this->checkRole) && $this->checkRole['id'] != auth()->guard('admin')->user()->role->role_id) {
                    $admin_status = 0;
                    $user_status = 1;
                    $inboxExist = Inboxe::select('id')->where('receiver',$req->get('chat_sender_id'))->where('sender',$req->get('chat_reciver_id'))->first();
                } else {
                    $admin_status = 1;
                    $user_status = 0;
                    $inboxExist = Inboxe::select('id')->where('receiver',$req->get('chat_reciver_id'))->where('sender',$req->get('chat_sender_id'))->first();
                }
                
                if(empty($inboxExist)) {
                    $inbox= new Inboxe([
                        'sender' => $req->get('chat_sender_id'),
                        'receiver' => $req->get('chat_reciver_id'),
                    ]);
                    $inbox->save();
                    $messages = new Message([
                        'inbox_id' => $inbox->id,
                        'sender' => $req->get('chat_sender_id'),
                        'receiver' => $req->get('chat_reciver_id'),
                        'msg'   => $req->get('chat_text'),
                        'msg_type' => 0,
                        'admin_read_status' =>$admin_status,
                        'user_read_status' => $user_status,
                    ]);
    
                    $messages->save();
                } else {
                    
                    $messages = new Message([
                        'inbox_id' => $inboxExist->id,
                        'sender' => $req->get('chat_sender_id'),
                        'receiver' => $req->get('chat_reciver_id'),
                        'msg'   => $req->get('chat_text'),
                        'msg_type' => 0,
                        'admin_read_status' =>$admin_status,
                        'user_read_status' => $user_status,
                    ]);
    
                    $messages->save();
                }

                event(new \App\Events\ChatUpdate(['subject'=>'You have new message','msg'=>$req->get('msg')],$req->get('receiver')));
                $Response = ['message'=>'Message sended successfully!','status'=>1];
            } catch (\Exception $e) {
                $Response =['message'=>$e->getMessage(),'status'=>0];
            }
        }

        return response()->json($Response,200);
    }

    protected function chatSendFilesFunction(Request $req) {

            $this->modification('Admin.Chat.ChatBoatController');
            $messages = [
                'required'=>'The :attribute field is required'
            ];

            $Validator = Validator::make(

                $req->only('chat_sender_id','chat_reciver_id','files'),            
                [ 
                    // 'chat_text' =>'nullable',
                    'chat_sender_id' => 'required|numeric|exists:admins,id',
                    'chat_reciver_id' => 'required|numeric|exists:admins,id',                
                ],
                $messages
            );

            if($Validator->fails()){
                // $Response = $Validator->messages();
                $Response = ['message'=>'Something went going wrong from server..!','status'=>0];
            }
            else{
                try{
                    if(!empty($this->checkRole) && $this->checkRole['id'] != auth()->guard('admin')->user()->role->role_id) {
                        $inboxExist = Inboxe::select('id')->where('receiver',$req->get('chat_sender_id'))->where('sender',$req->get('chat_reciver_id'))->first();   
                        $admin_status = 0;
                        $user_status = 1;    
                    } else {
                        $inboxExist = Inboxe::select('id')->where('receiver',$req->get('chat_reciver_id'))->where('sender',$req->get('chat_sender_id'))->first();
                        $admin_status = 1;
                        $user_status = 0;
                    }
                    
                    

                    $images = [];
                    if(!empty($this->checkRole) && $this->checkRole['id'] != auth()->guard('admin')->user()->role->role_id) {
                        if(!empty($req->file('files'))) {
                            for($i = 0; $i < count($req->file('files')); $i++){
                                $req->file('files')[$i]->store('public/chats/'.$req->get('chat_sender_id').'/sent'.'');
                                $images[] = $req->file('files')[$i]->store('public/chats/'.$req->get('chat_reciver_id').'/receive'.'');
                            }                        
                        }
                    } else {
                        if(!empty($req->file('files'))) {
                            for($i = 0; $i < count($req->file('files')); $i++){
                                $images[] = $req->file('files')[$i]->store('public/chats/'.$req->get('chat_sender_id').'/sent'.'');
                                $req->file('files')[$i]->store('public/chats/'.$req->get('chat_reciver_id').'/receive'.'');
                            }                        
                        }
                    }
                    
                    if(empty($inboxExist)) {
                        $inbox= new Inboxe([
                            'sender' => $req->get('chat_sender_id'),
                            'receiver' => $req->get('chat_reciver_id'),
                        ]);
                        $inbox->save();
                        $messages = new Message([
                            'inbox_id' => $inbox->id,
                            'sender' => $req->get('chat_sender_id'),
                            'receiver' => $req->get('chat_reciver_id'),
                            'msg'   => json_encode($images),
                            'msg_type' => 1,
                            'admin_read_status' =>$admin_status,
                            'user_read_status' => $user_status,
                        ]);
        
                        $messages->save();
                    } else {
                        
                        $messages = new Message([
                            'inbox_id' => $inboxExist->id,
                            'sender' => $req->get('chat_sender_id'),
                            'receiver' => $req->get('chat_reciver_id'),
                            'msg'   => json_encode($images),
                            'msg_type' => 1,
                            'admin_read_status' =>$admin_status,
                            'user_read_status' => $user_status, 
                        ]);
        
                        $messages->save();
                    }

                    event(new \App\Events\ChatUpdate(['subject'=>'You have new message','msg'=>$req->get('msg')],$req->get('receiver')));
                    $Response = ['message'=>'Message sended successfully!','status'=>1];
                } catch (\Exception $e) {
                    $Response =['message'=>$e->getMessage(),'status'=>0];
                }
            }
            return response()->json($Response,200);
    }
    protected function chatGetdataUser(Request $req) {
        
            try{   
                DB::statement("SET SQL_MODE=''");//this is the trick use it just before your query
                if(!empty($this->checkRole) && $this->checkRole['id'] != auth()->guard('admin')->user()->role->role_id) {
                    $chatList = Inboxe::leftJoin('messages',function($join){
                        $join->on('inboxes.id','=','messages.inbox_id');
                    })->select('messages.*')->where('inboxes.sender',$req->get('id'))->where('inboxes.receiver',Auth::guard('admin')->user()->id)->get();

                    // update notification system:
                        $getairId = DB::table('inboxes')
                                    ->join('messages','messages.inbox_id','=','inboxes.id')
                                    ->where('inboxes.sender', $req->get('id'))
                                    ->update(array("messages.user_read_status"=>1));

                    $chat = [];
                    if(count($chatList) > 0) {
                        foreach ($chatList as $msg) {
                            
                            if($msg->receiver != Auth::guard('admin')->user()->id) {
                                $owner = 'owner';
                            } else {
                                $owner = '';
                            }
                            $images  = []; 
                            
                            if($msg->msg_type == 1) {
                                if(!empty(json_decode($msg->msg))){
                                    
                                    foreach (json_decode($msg->msg) as $image) {
                                        
                                        if(!empty(explode('public/',$image)[1])) {
                                            $images[] = '/storage'.explode('public',$image)[1];
                                        }
                                     
                                    }
                                }
                            }

                            
                            $chat[] = [
                                'direction' => $owner,
                                'msg' => $msg->msg,
                                'msg_type' => $msg->msg_type,
                                'msg_attachment' => $images, 
                                'created' => date('h:i A',strtotime($msg->created_at))
                            ];
                        }
                    }

                    $Response =['message'=>$chat,'status'=>1];
                    

                } else {
                   
                    $chatList = Inboxe::leftJoin('messages',function($join){
                        $join->on('inboxes.id','=','messages.inbox_id');
                    })->select('messages.*')->where('inboxes.receiver',$req->get('id'))->where('inboxes.sender',Auth::guard('admin')->user()->id)->get();
                    $chat = [];

                    // update notification system:
                        $getairId = DB::table('inboxes')
                                    ->join('messages','messages.inbox_id','=','inboxes.id')
                                    ->where('inboxes.receiver', $req->get('id'))
                                    ->update(array("messages.admin_read_status"=>1));

                    if(count($chatList) > 0) {
                        foreach ($chatList as $msg) {
                            
                            if($msg->receiver != Auth::guard('admin')->user()->id) {
                                $owner = 'owner';
                            } else {
                                $owner = '';
                            }
                            $images  = []; 
                            
                            if($msg->msg_type == 1) {
                                if(!empty(json_decode($msg->msg))){
                                    
                                    foreach (json_decode($msg->msg) as $image) {
                                        
                                        if(!empty(explode('public/',$image)[1])) {
                                            $images[] = '/storage'.explode('public',$image)[1];
                                        }
                                     
                                    }
                                }
                            }

                            
                            $chat[] = [
                                'direction' => $owner,
                                'msg' => $msg->msg,
                                'msg_type' => $msg->msg_type,
                                'msg_attachment' => $images, 
                                'created' => date('h:i A',strtotime($msg->created_at))
                            ];
                        }
                    }
                    $Response =['message'=>$chat,'status'=>1];
                }
            } catch (\Exception $e) {
                $Response =['message'=>$e->getMessage(),'status'=>0];
            }
        

        return response()->json($Response,200);
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
