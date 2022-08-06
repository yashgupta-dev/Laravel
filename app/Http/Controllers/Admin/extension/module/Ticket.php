<?php

namespace App\Http\Controllers\Admin\extension\module;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\Common\CommonSettingController;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;

use App\Models\Role;
use App\Models\Setting;

use Auth;
use DB;

class Ticket extends Controller
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
        $this->middleware('masteraccess:Admin.extension.module.Ticket');
        $this->per_page = empty(config('settings.config_pagination')) ? 10 : config('settings.config_pagination');
    }

    /**
     * Show the Admin dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
    */
    public function index() {
        
        if(view()->exists('admin.extension.module.ticket')){
            $result = getSetting('ticket');
            $data = [
                'ticket_module_status' => isset($result['ticket_module_status']) ? $result['ticket_module_status'] : 0,
                'ticket_module_attachment' => isset($result['ticket_module_attachment']) ? $result['ticket_module_attachment'] : '',
                'ticket_module_extension' => isset($result['ticket_module_extension']) ? $result['ticket_module_extension'] : '',
                'ticket_module_filesize' => isset($result['ticket_module_filesize']) ? $result['ticket_module_filesize'] : '',
                'all_status' => (new CommonSettingController)->getStatus(),
                'ticket_module_default_status' => isset($result['ticket_module_default_status']) ? $result['ticket_module_default_status'] : '',
                'ticket_module_open_status' => isset($result['ticket_module_open_status']) ? $result['ticket_module_open_status'] : '',
                'ticket_module_note_status' => isset($result['ticket_module_note_status']) ? $result['ticket_module_note_status'] : '',
                'ticket_module_select_ticket_status' => isset($result['ticket_module_select_ticket_status']) ? $result['ticket_module_select_ticket_status'] : '',
                'ticket_module_select_ticket_reply' => isset($result['ticket_module_select_ticket_reply']) ? $result['ticket_module_select_ticket_reply'] : '',
                'ticket_module_select_ticket_customer_reply' => isset($result['ticket_module_select_ticket_customer_reply']) ? $result['ticket_module_select_ticket_customer_reply'] : '',
            ];
            
            return view('admin.extension.module.ticket',compact('data'));
        }
    }

    protected function edit(Request $req) {
        $this->modification('Admin.extension.module.Ticket');
        $messages = [
            'required'=>'The :attribute field is required'
        ];

        $Validator = Validator::make(

            $req->only('ticket_module_status','ticket_module_attachment','ticket_module_default_status','ticket_module_open_status','ticket_module_select_ticket_status','ticket_module_extension','ticket_module_filesize'),
            
            [
                'ticket_module_attachment' =>'required|numeric|regex:/^[0-9]+$/u',
                'ticket_module_extension' =>'required',
                'ticket_module_status' => 'in:0,1',
                'ticket_module_default_status' => 'required',
                'ticket_module_open_status' => 'required',
                'ticket_module_filesize' =>'required|numeric|regex:/^[0-9]+$/u',
            ],
            $messages
        );

        if($Validator->fails()){
            $Response =$Validator->messages();
        }
        else{
            try{
                
                $message = editSetting('ticket',$_POST);
                
                $Response =['success_message'=>$message,'title'=>'Success! ','alert'=>'alert-fill-success'];                

            } catch (\Exception $e) {
                $Response =['error_message'=>$e->getMessage(),'title'=>'Warning! ','alert'=>'alert-fill-warning'];                
            }
        }
        return redirect(url()->previous())->withErrors($Response)->withInput();   
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
