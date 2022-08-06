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

class Facebook extends Controller
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
        $this->middleware('masteraccess:Admin.extension.module.Facebook');
        $this->per_page = empty(config('settings.config_pagination')) ? 10 : config('settings.config_pagination');
    }

    /**
     * Show the Admin dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
    */
    public function index() {
        
        if(view()->exists('admin.extension.module.facebook')){
            $result = getSetting('facebook');
            $data = [
                'facebook_module_status' => isset($result['facebook_module_status']) ? $result['facebook_module_status'] : 0,
                'facebook_module_title' => isset($result['facebook_module_title']) ? $result['facebook_module_title'] : '',
                'facebook_module_client_id' => isset($result['facebook_module_client_id']) ? $result['facebook_module_client_id'] :'',
                'facebook_module_client_secret_id' => isset($result['facebook_module_client_secret_id']) ? $result['facebook_module_client_secret_id']:'',
                'facebook_module_redirect_url' => isset($result['facebook_module_redirect_url']) ? $result['facebook_module_redirect_url']:'',
            ];
            return view('admin.extension.module.facebook',compact('data'));
        } 
    }

    protected function edit(Request $req) {
        $this->modification('Admin.extension.module.Facebook');
        $messages = [
            'required'=>'The :attribute field is required'
        ];

        $Validator = Validator::make(

            $req->only('facebook_module_title','facebook_module_client_id','facebook_module_client_secret_id','facebook_module_redirect_url','facebook_module_status'),
            
            [
                'facebook_module_title' =>'required|string|min:6|regex:/^[a-zA-Z]+$/u|max:20',
                'facebook_module_client_id' =>'required|numeric',
                'facebook_module_client_secret_id' =>'required|max:120',
                'facebook_module_redirect_url'=> 'required|url',
                'facebook_module_status' => 'in:0,1',
            ],
            $messages
        );

        if($Validator->fails()){
            $Response =$Validator->messages();
        }
        else{
            try{
                
                $message = editSetting('facebook',$_POST);
                $data = [
                    'facebook_CLIENT_ID' => $req->get('facebook_module_client_id'),
                    'facebook_CLIENT_SECRET' => $req->get('facebook_module_client_secret_id'),
                    'facebook_REDIRECT' => $req->get('facebook_module_redirect_url'),
                ];
                $Response = (new CommonSettingController)->editEnv($data);
    
                $Response =['success_message'=>$message,'title'=>'Success! ','alert'=>'alert-fill-success'];                

            } catch (\Exception $e) {
                $Response =['errro_message'=>$e->getMessage(),'title'=>'Warning! ','alert'=>'alert-fill-warning'];                
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
