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

class Google extends Controller
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
        $this->middleware('masteraccess:Admin.extension.module.Google');
        $this->per_page = empty(config('settings.config_pagination')) ? 10 : config('settings.config_pagination');
    }

    /**
     * Show the Admin dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
    */
    public function index() {
        
        if(view()->exists('admin.extension.module.google')){
            $result = getSetting('google');
            
            $data = [
                'google_module_status' => isset($result['google_module_status']) ? $result['google_module_status'] : 0,
                'google_module_title' => isset($result['google_module_title']) ? $result['google_module_title'] : '',
                'google_module_client_id' => isset($result['google_module_client_id']) ? $result['google_module_client_id'] :'',
                'google_module_client_secret_id' => isset($result['google_module_client_secret_id']) ? $result['google_module_client_secret_id']:'',
                'google_module_redirect_url' => isset($result['google_module_redirect_url']) ? $result['google_module_redirect_url']:'',
                'google_module_api_key' => isset($result['google_module_api_key']) ? $result['google_module_api_key']:'',
            ];
            return view('admin.extension.module.google',compact('data'));
        } 
    }

    protected function edit(Request $req) {
        $this->modification('Admin.extension.module.Google');
        $messages = [
            'required'=>'The :attribute field is required'
        ];

        $Validator = Validator::make(

            $req->only('google_module_title','google_module_api_key','google_module_client_id','google_module_client_secret_id','google_module_redirect_url','google_module_status'),
            
            [
                'google_module_title' =>'required|string|min:6|regex:/^[a-z A-Z]+$/u|max:20',
                'google_module_client_id' =>'required',
                'google_module_client_secret_id' =>'required|max:120',
                'google_module_redirect_url'=> 'required|url',
                'google_module_status' => 'in:0,1',
                'google_module_api_key' => 'required',
            ],
            $messages
        );

        if($Validator->fails()){
            $Response =$Validator->messages();
        }
        else{
            try{
                
                $message = editSetting('google',$_POST);
                $data = [
                    'GOOGLE_CLIENT_ID' => $req->get('google_module_client_id'),
                    'GOOGLE_CLIENT_SECRET' => $req->get('google_module_client_secret_id'),
                    'GOOGLE_REDIRECT' => $req->get('google_module_redirect_url'),
                ];
                $Response = (new CommonSettingController)->editEnv($data);
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
