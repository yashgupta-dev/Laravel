<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Common\CommonSettingController;

use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Notifications\User\Welcome;

use App\Notifications\Other as Other;
use App\Models\Site;
use App\Models\Slider;
use App\Models\Setting;
use App\Models\Admin;
use App\Models\User;
use App\Models\Role;
use App\Models\Admin_role;
use App\Models\Role_user;

use DB;
use Auth;
use Lang;
use Artisan;

class SettingController extends Controller
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
        $this->middleware('masteraccess:Admin.SettingController');
        $this->per_page = empty(config('settings.config_pagination')) ? 10 : config('settings.config_pagination');
    }

    /**
     * Show the Admin Setting.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    protected function logoChangeFUnction(Request $req){
        $this->modification('Admin.SettingController');
        $messages = [
            'required'=>'The :attribute field is required'
        ];

        $Validator = Validator::make(
        $req->only('image'),
            [
                'image' => 'image|mimes:png,jpg,jpeg,svg|max:1048',
            ],
            $messages
        );

        if($Validator->fails()){
            $Response = $Validator->messages();
        }else{
           try{
                $domain = 0;
                $folder = Storage::makeDirectory('public/logo/'.$domain);
                $find = Site::where('panelId',$domain)->first();
                if(!empty($find)):
                    if(isset($find->logo)):
                        $path = explode('/',$find->logo)[3];
                        Storage::disk('logo')->delete($path);
                    endif;
                    $find->logo = $req->file('image')->store('public/logo/0');
                    $find->save();
                    $Response = ['ok'=>'logo changes saved'];
                else:
                    $new = new Site([
                        'panelId' => $domain,
                        'logo' => $req->file('image')->store('public/logo/0'),
                    ]);
                    $new->save();
                    $Response = ['ok'=>'logo changes saved'];
                endif;
                $links = '<a href="javascript" class="dropdown-item"><div class="icon" style="padding: 15px;"><i class="fas fa-cube text-info"></i></div><div class="content"><p>Our Logo has been changed</p><p class="sub-text text-muted"></p></div></a>';
                $data = [
                    'to'=>[
                        // 'user'=>'setNotification'.$req->get('userid'),
                        'links' => $links,
                            ],
                        ];
                    // $this->_createNotification('to',$links,'all');
                    // $this->_broadcast($data);
                
            } catch (\Exception $e) {

                $Response =['image'=>$e->getMessage()];
            }
        }
        return response()->json($Response,200);
    }
    
    protected function faviconChangeFUnction(Request $req){
        $this->modification('Admin.SettingController');
        $messages = [
            'required'=>'The :attribute field is required'
        ];

        $Validator = Validator::make(
        $req->only('image'),
            [
                'image' => 'image|mimes:png,jpg,jpeg,svg|max:1048',
            ],
            $messages
        );

        if($Validator->fails()){
            $Response = $Validator->messages();
        }else{
           try{
                $domain = 0;
                // $folder = Storage::makeDirectory('public/logo/0/favicon/');
                $find = Site::where('panelId',$domain)->first();
                if(!empty($find)):
                    if(isset($find->favicon)):
                        $path = explode('/',$find->favicon)[4];
                        Storage::disk('favicon')->delete($path);
                    endif;
                    $find->favicon = $req->file('image')->store('public/logo/0/favicon');
                    $find->save();
                    $Response = ['ok'=>'favicon changes saved'];
                else:
                    $new = new Site([
                        'panelId' => $domain,
                        'favicon' => $req->file('image')->store('public/logo/0/favicon'),
                    ]);
                    $new->save();
                    $Response = ['ok'=>'favicon changes saved'];
                endif;
                $links = '<a href="javascript" class="dropdown-item"><div class="icon" style="padding: 15px;"><i class="fas fa-cube text-info"></i></div><div class="content"><p>Our Logo has been changed</p><p class="sub-text text-muted"></p></div></a>';
                $data = [
                    'to'=>[
                        // 'user'=>'setNotification'.$req->get('userid'),
                        'links' => $links,
                            ],
                        ];
                    // $this->_createNotification('to',$links,'all');
                    // $this->_broadcast($data);
                
            } catch (\Exception $e) {

                $Response =['image'=>$e->getMessage()];
            }
        }
        return response()->json($Response,200);
    }
    
    public function SiteImageunction(){
        if(Request()->q){
            switch (Request()->q) {
                case 'logo':
                    return view('admin.web-site.logo');
                    break;
                case 'favicon':
                    return view('admin.web-site.favicon');
                    break;
                default:
                    $Response = ['failure_message'=>'Not found view, Try after some time!', 'icon'=>'search'];
                    return redirect(route('admin.web'))->withErrors($Response)->withInput();
                    break;
            }
        }else{
            $Response = ['failure_message'=>'Oops! something missing!', 'icon'=>'search'];
            return redirect(route('admin.web'))->withErrors($Response)->withInput();
        }
    }

    protected function settingFunction(){
        
        $file = storage_path('logs/laravel.log');
        $size = filesize($file);
        $filesize = round($size / 1024 / 1024, 1); // megabytes with 1 digit
        if($filesize > 5) {
            $log = true;
            return view('admin.pages.setting.setting',compact('log'));
        } else {
            
            $log = file_get_contents($file, FILE_USE_INCLUDE_PATH, null);
            return view('admin.pages.setting.setting',compact('log'));
        }
        
        
    }

    protected function deletedataFunction(){
        $this->modification('Admin.SettingController');
        if(Request()->csrf_token && Request()->delete && Request()->id){
            try{
                $type = explode(' ',Request()->delete)[0];
                $table = explode(' ',Request()->delete)[1];
                $folder = explode(' ',Request()->delete)[2];
                // $Response =['er'=>$type];
                $id = Request()->id;
                if($type == 'soft'){
                    $Response = $this->_softDelete($table,$folder,$id);
                }elseif($type == 'permanent'){
                    $Response = $this->_hardDelete($table,$folder,$id);
                }else{
                    $Response = ['failure_message'=>'something went wrong, try after some time!'];
                }

            } catch (\Exception $e) {
                $Response =['error_message'=>$e->getMessage()];
            } 
        }else{
            $Response = ['failure_message'=>'something went wrong, try after some time!'];
        }
        return redirect(url()->previous())->withErrors($Response)->withInput();   
    }

    protected function _softDelete($table,$folder,$id){
        return ['success_message'=>'we working on it'];
    }

    protected function _hardDelete($table,$folder,$id){
        try{
            $img = DB::table($table)->where('id',$id)->first();
            if($img != null){
                // $img = explode('/', $img->img)[2];
                if($img->img != null){
                    Storage::disk($folder)->delete(explode('/', $img->img)[2]);
                }
                DB::table($table)->where('id',$id)->delete();
                    return ['success_message'=>'Data has been removed'];    
                } else{
                    return ['failure_message'=>'Oops! like data doesn\'t exist'];    
                }
        } catch (\Exception $e) {
            return ['error_message'=>$e->getMessage()];
        } 
    }

    protected function settingFunctionEdit(){
        $path = base_path('.env');
        if (file_exists($path)) {
            //Try to read the current content of .env
           $env = file_get_contents($path);   
        }
        return view('admin.pages.setting.env',compact('env'));
        
    }

    protected function updateSettingFile(Request $req){
        $this->modification('Admin.SettingController');
        $messages = [
            'required'=>'The :attribute field is required'
        ];

        $Validator = Validator::make(
        $req->only('env'),
            [
                'env'=> 'required',
            ],
            $messages
        );

        if($Validator->fails()){
            $Response = $Validator->messages();
        }else{
           try{ 
                // $data = [];
                $data = $req->get('env');
                // $data = explode("\n", str_replace("\r", "", $data1));
            
                $envFile = base_path() . '/.env';
                // $lines = file($envFile);
                // $newLines = [];
                
                // foreach ($data as $key => $value) {
                //     if(empty($value)){
                //         $newLines[] = '';
                //     } else {
                //         $newLines[] = explode('=',$lines[$key])[0].'='.explode('=',$value)[1];
                        
                //     }
                    
                // }
                // $newContent = implode('\n', $newLines);
                $fp = fopen($envFile, "r+");
                // clear content to 0 bits
                ftruncate($fp, 0);
                //close file
                file_put_contents($envFile, $data);
                fclose($fp);
                
                $Response = ['success_message'=>'.env file updated successfully'];
                
            } catch (\Exception $e) {

                $Response =['error_message'=>$e->getMessage()];
            }
        }
        return redirect(url()->previous())->withErrors($Response)->withInput();    
    }

    protected function clearLogsFunction(){
        $this->modification('Admin.SettingController');
        try{ 
            
            $fp = fopen(storage_path('logs/laravel.log'), "r+");
            // clear content to 0 bits
            ftruncate($fp, 0);
            //close file
            fclose($fp);
            
            $Response = ['success_message'=>'error_logs file has been cleared.'];
            
        } catch (\Exception $e) {

            $Response =['error_message'=>$e->getMessage()];
        }   
        return redirect(url()->previous())->withErrors($Response)->withInput();    
    }

    protected function cacheClear(){
        Artisan::call('cache:clear');
        return redirect(url()->previous())->withErrors(['ok'=>'cache clear successfully'])->withInput();   
    }
    protected function viewClear(){
        Artisan::call('view:clear');
        return redirect(url()->previous())->withErrors(['ok'=>'view clear successfully'])->withInput();   
    }

    public function permissionFunction() {
        $roles = Role::paginate($this->per_page);

        return view('admin.web-site.permission',compact('roles'));
    }

    protected function permissions($id, $name, Request $request) {

        if (!empty($id) && isset($id) && ! $request->isMethod('post')) {
			$user_group_info = $this->_getUserGroup($id);
		}

        $data['id']  = $id;

        if(!empty(json_decode($user_group_info['permission'],true)['access'])) {
            $data['access'] = json_decode($user_group_info['permission'],true)['access'];
        } else {
            $data['access'] = '';
        }
        

        if(!empty(json_decode($user_group_info['permission'],true)['modify'])) {
            $data['modify'] = json_decode($user_group_info['permission'],true)['modify'];
        } else {
            $data['modify'] = '';
        }
        $ignore_folder = [
            'Auth',
            'Setup',
            'Socialite',
        ];
        $ignore_file = [
            'Controller',
            'HomeController',
            'Welcome',
        ];
		$files = array();
        $data['permissions'] = array();
		// Make path into an array
		$path = array(base_path().'/app/Http/Controllers/*');
        // While the path array is still populated keep looping through
		while (count($path) != 0) {
			$next = array_shift($path);
			foreach (glob($next) as $file) {
				// If directory add to path array
				if (is_dir($file)) {
					$path[] = $file . '/*';
				}
				// Add the file to the files to be deleted array
				if (is_file($file)) {
					$files[] = $file;
				}
			}
		}
		sort($files);					
		foreach ($files as $file) {
			$controller = substr($file, strlen(base_path().'/app/Http/Controllers/'));
            $getPath = explode('/',$controller);
            if(!empty($getPath[0]) && isset($getPath[0]))
                if (!in_array($getPath[0], $ignore_folder)) {
                    if(!empty($getPath[1]) && isset($getPath[1]))
                        if (!in_array($getPath[1], $ignore_folder)) {
                            $permission = substr($controller, 0, strrpos($controller, '.'));
                            if (!in_array($permission, $ignore_file))
                                $data['permissions'][] = $permission;
                        }
                }
		}

        return view('admin.web-site.permission_form',$data); 
    }


    protected function permission_addFunction(Request $request) {
        $this->modification('Admin.SettingController');
        $messages = [
            'required'=>'The :attribute field is required'
        ];
        
        $Validator = Validator::make(
        $request->only('id','name','descrption'),
            [
                'id' => 'required||exists:roles,id',
            ],
            $messages
        );

        if($Validator->fails()){
            $Response = $Validator->messages();
        }else{
            try{
                
                $data = Role::find($request->get('id'));                
                $data->permission = json_encode($request->get('permission'));
                $data->save();
                $Response =['success_message'=>'permission updated successfully'];

            } catch (\Exception $e) {
                $Response =['error_message'=>$e->getMessage()];
            }
        }
        return redirect(url()->previous())->withErrors($Response)->withInput();   
        
    }

    protected function roleAddFunction() {
        $ignore_folder = [
            'Auth',
            'Setup',
            'Socialite',
        ];
        $ignore_file = [
            'Controller',
            'HomeController',
            'Welcome',
        ];
		$files = array();
        $data['permissions'] = array();
		// Make path into an array
		$path = array(base_path().'/app/Http/Controllers/*');
        // While the path array is still populated keep looping through
		while (count($path) != 0) {
			$next = array_shift($path);
			foreach (glob($next) as $file) {
				// If directory add to path array
				if (is_dir($file)) {
					$path[] = $file . '/*';
				}
				// Add the file to the files to be deleted array
				if (is_file($file)) {
					$files[] = $file;
				}
			}
		}
		sort($files);					
		foreach ($files as $file) {
			$controller = substr($file, strlen(base_path().'/app/Http/Controllers/'));
            $getPath = explode('/',$controller);
            if(!empty($getPath[0]) && isset($getPath[0]))
                if (!in_array($getPath[0], $ignore_folder)) {
                    if(!empty($getPath[1]) && isset($getPath[1]))
                        if (!in_array($getPath[1], $ignore_folder)) {
                            $permission = substr($controller, 0, strrpos($controller, '.'));
                            if (!in_array($permission, $ignore_file))
                                $data['permissions'][] = $permission;
                        }
                }
		}
        return view('admin.web-site.role_add',$data);
    }

    protected function roleCreateFunction(Request $request) {
        $this->modification('Admin.SettingController');
        $messages = [
            'required'=>'The :attribute field is required'
        ];
        
        $Validator = Validator::make(
        $request->only('name','descrption'),
            [
                'name' => 'required|string|regex:/^[a-zA-Z]+$/u|max:20|unique:roles,name',
                'descrption' => 'required|max:180',
            ],
            $messages
        );

        if($Validator->fails()){
            $Response = $Validator->messages();
        }else{
            try{
                
                
                Role::create([
                    'name' => $request->get('name'),
                    'description' => $request->get('descrption'),
                    'permission' => json_encode($request->get('permission')),
                ]);

                $Response =['success_message'=>'Role added successfully','color'=>'success'];

            } catch (\Exception $e) {
                $Response =['error_message'=>$e->getMessage(),'color'=>'danger'];
            }
        }
        return redirect(url()->previous())->withErrors($Response)->withInput();   
    }

    protected function routesPermissionFunction() {
        $ignore_files = [
            '_ignition/health-check',
            '_ignition/execute-solution',
            '_ignition/share-report',
            '_ignition/scripts/{script}',
            '_ignition/styles/{style}',
            'notify/demo',
            'broadcasting/auth',
            'setup/install',
            'setup/finish',
            'setup/finshing/installing',
            'setup/register',
            
        ];
		// $files = array();
        $data['permissions'] = array();
		// Make path into an array
		$routes = [];
        foreach (\Route::getRoutes()->getIterator() as $route){
            // if (strpos($route->uri, 'api') !== false){
                $routes[] = $route->uri;
            // }
        }
		foreach ($routes as $file) {
            
		    if (!in_array($file, $ignore_files)) {
                $data['permissions'][] = $file;
            }
        }

        return view('admin.web-site.role_add',$data);
    }

    private function _getUserGroup($id) {
        return Role::where('id',$id)->select('permission','name','description')->first();
    }

    // setting table;
    protected function ConfigrationTable(){
        
        $files = array();
        $data['module'] = array();
		// Make path into an array
		$path = array(base_path().'/app/Http/Controllers/Admin/extension/module/*');
        $languagepath = base_path().'/resources/lang/en/extension/module/';
        // While the path array is still populated keep looping through
		while (count($path) != 0) {
			$next = array_shift($path);
			foreach (glob($next) as $file) {
				// If directory add to path array
				if (is_dir($file)) {
					$path[] = $file . '/*';
				}
				// Add the file to the files to be deleted array
				if (is_file($file)) {
					$files[] = $file;
				}
			}
		}
		sort($files);					
		foreach ($files as $file) {
			$controller = substr($file, strlen(base_path().'/app/Http/Controllers/Admin/extension/module/'));
            $getPath = explode('/',$controller);
            if(!empty($getPath[0]) && isset($getPath[0]))
                $permission = lcfirst(substr($controller, 0, strrpos($controller, '.')));
                $data['module'][] = [
                    'name' => Lang::get(''.$permission.'.title'),
                    'status' => config('settings.'.lcfirst($permission).'_module_status'),
                    'path' => '/admin/extension/module/'.lcfirst($permission),
                ];
		}
        $extension = $data['module'];
        return view('admin.web-site.config',compact('extension'));
    }    

    public function UserPanelView() {
        
        return view('admin.web-site.user-panel');
    }

    protected function saveEnvFunction(Request $req){
        $Response = (new CommonSettingController)->editEnv($_POST);

        return redirect(url()->previous())->withErrors($Response)->withInput();         
        
    }
    protected function UserPanel_config() {
        
        $data = Setting::where('code','config')->get();
        
        return response()->json($data);

    }

    protected function UserPanel_config_update($id){
        return response()->json($this->_privateStatusChange($id));
    }

    protected function ConfigFunction() {
        $data = [
            'roles' => $this->_GetUserGroups(),
        ];
        return view('admin.web-site.setting',compact('data'));   
    }

    private function _GetUserGroups() {
        return Role::get();
    }

    protected function saveSettingFunction(Request $request) {
        $this->modification('Admin.SettingController');
        
        $messages = [
            'required'=>'The :attribute field is required'
        ];

        $Validator = Validator::make(
        $request->only('config_site_url','config_mime_type','config_max_upload_size','config_store_name','config_loder_type','config_loder_name','config_loder_color','config_pagination','config_default_group','config_profile_edit','config_password_edit','config_two_way_authentication','config_other_devices','config_ticket_support_panel','config_account_create','config_user_account_login'),
            [
                'config_store_name'=> 'required',
                'config_loder_type'=> 'required|in:default,text|',
                'config_pagination' => 'required|numeric|min:10|max:100',
                'config_loder_name' => 'nullable|max:10',
                'config_site_url' => 'required|url',
                'config_loder_color'    => 'nullable',
                'config_default_group' => 'required|numeric',
                'config_profile_edit' => 'required|numeric|in:0,1',
                'config_password_edit' => 'required|numeric|in:0,1',
                'config_two_way_authentication' => 'required|numeric|in:0,1',
                'config_other_devices' => 'required|numeric|in:0,1',
                'config_ticket_support_panel' => 'required|numeric|in:0,1',
                'config_account_create' => 'required|numeric|in:0,1',
                'config_user_account_login' => 'required|numeric|in:0,1',
                
            ],
            $messages
        );

        if($Validator->fails()){
            $Validator->errors()->add('error', 'Please fill fields carefully!');
            $Response = $Validator->messages();
            return redirect(url()->previous())->withErrors($Response)->withInput();   
        }else{
           try{
            $message = editSetting('config',$_POST);
                
            $Response =['success_message'=>$message];
            return redirect(route('admin.web.site'))->withErrors($Response)->withInput();   
               
            } catch (\Exception $e) {
                $Response =['error_message'=>$e->getMessage(),'color'=>'danger'];
                return redirect(url()->previous())->withErrors($Response)->withInput();   
            }
        }
        
    }

    private function _privateStatusChange($id){
        try{
            $getSetting = Setting::where('setting_id',$id)->first();
            if($getSetting['value'] == 1) {
                Setting::where('setting_id',$id)->update(['value'=>0]);
            } else {
                Setting::where('setting_id',$id)->update(['value'=>1]);
            }
            return ['success_message'=>'changes successfully updated','color'=>'success'];
        } catch (\Exception $e) {
            return ['error_message'=>$e->getMessage(),'color'=>'danger'];
        }

    }

    protected function userGroupDeleteFunction(Request $request) {
        $this->modification('Admin.SettingController');
        $messages = [
            'required'=>'The :attribute field is required'
        ];

        $Validator = Validator::make(
        $request->only('selected'),
            [
                'selected*'=> 'required|exists:roles,id',
            ],
            $messages
        );

        if($Validator->fails()){
            $Response = $Validator->messages();
        }else{
           try{
                if(!empty($request->get('selected'))) {
                    foreach($request->get('selected') as $key) {
                        Role::where('id',$key)->delete();
                        Role_user::where('role_id',$key)->update(array('role_id'=>0));
                        Admin_role::where('role_id',$key)->update(array('role_id'=>0));
                    }
                    $Response =['success_message'=>'Record deleted successfully.','color'=>'success'];
                } else {
                    $Response =['failure_message'=>'Please select record to delete','color'=>'danger'];
                }
               
            } catch (\Exception $e) {
                $Response =['error_message'=>$e->getMessage(),'color'=>'danger'];
            }
        }

        return redirect(url()->previous())->withErrors($Response)->withInput();   
    }

    public function createUserFunction()
    {
        $data = Role::get();
        return view('admin.web-site.create-user',compact('data'));
    }

    protected function createConfirmUserFunction(Request $req) {
        $this->modification('Admin.SettingController');
        $messages = [
            'required'=>'The :attribute field is required'
        ];

        $Validator = Validator::make(
        $req->only('name','email','phone','password','password_confirmation','group'),
            [
                'group' => 'required|exists:roles,id',
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:admins',
                'phone' => 'required|numeric|digits:10|regex:/^([0-9\s\-\+\(\)]*)$/|unique:admins',
                'password' => 'required|string|min:8|confirmed',
            ],
            $messages
        );

        if($Validator->fails()){
            $Response = $Validator->messages();
        }else{
           try{
                $getGroup = Role::find($req->get('group'));
                if($getGroup->name != 'Default'){
                    $admin = new Admin([
                        'name' => $req->get('name'),
                        'email' => $req->get('email'),
                        'profile' => array_rand(['0','1'],1),
                        'phone' => $req->get('phone'),
                        'password' => Hash::make($req->get('password')),
                    ]);
                    $admin->save();
                    $admin->notify(new Welcome($req));
                    DB::table('admin_role')->insert(['role_id'=>$req->get('group'),'user_id'=>$admin->id]);
                } else {
                    $user = new User([
                        'name' => $req->get('name'),
                        'email' => $req->get('email'),
                        'profile' => array_rand(['0','1'],1),
                        'phone' => $req->get('phone'),
                        'password' => Hash::make($req->get('password')),
                    ]);
                    $user->save();
                    $user->notify(new Welcome($req));
                    DB::table('role_user')->insert(['role_id'=>$req->get('group'),'user_id'=>$user->id]);
                }               

               $Response = ['success_message'=>'user created successfully!','color'=>'success'];
            } catch (\Exception $e) {

                $Response =['error_message'=>$e->getMessage(),'color'=>'danger'];
            }
        }
         return redirect(url()->previous())->withErrors($Response)->withInput();   
    }
    public function getUserListFunction() {
        $client = $this->_getClientsRecord();
        return view('admin.web-site.user',compact('client'));
    }
    private function _getClientsRecord(){
        return Admin::paginate($this->per_page);
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
