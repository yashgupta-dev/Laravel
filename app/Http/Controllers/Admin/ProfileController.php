<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

use App\Notifications\Other as Other;
use App\Models\Admin;
use App\Models\Role;
use Auth;

class ProfileController extends Controller
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
        $this->middleware('masteraccess:Admin.ProfileController');
        $this->per_page = empty(config('settings.config_pagination')) ? 10 : config('settings.config_pagination');
    }

    /**
     * Show the Admin Profile.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profilePageFunction(){
        return view('admin.pages.profile.profile');
    }
    
    protected function passwordUpdateEdit(Request $req){
        $this->modification('Admin.ProfileController');
        $messages = [
            'required'=>'The :attribute field is required'
        ];

        $Validator = Validator::make(
        $req->only('current_password','password','password_confirmation'),
            [
                'current_password'=> 'required|string|min:8|max:20',
                'password' => 'required|string|min:8|max:20|confirmed',
            ],
            $messages
        );

        if($Validator->fails()){
            $Response = $Validator->messages();
        }else{
           try{
                
               $Response = $this->_passwordCheckExist($req->get('current_password'), $req->get('password'));
            } catch (\Exception $e) {

                $Response =['error_message'=>$e->getMessage()];
            }
        }
        return redirect(url()->previous())->withErrors($Response)->withInput();   
    }

    protected function _passwordCheckExist($pass,$newpass){
        $check = Admin::where('id',Auth::guard('admin')->user()->id)->select('password')->first();
        if (Hash::check($pass,$check->password)) {
            $check->password = Hash::make($newpass);
            $check->save();    
            $check->update([
                'password' => Hash::make($newpass),
            ]);
            Auth::guard('admin')->user()->notify(new Other('You have changed password','user','/admin/profile')); 
            return ['success_message'=>'Password successfully changed.']; 
        }else{
            return ['current_password'=>'current password doesn\'t match','er'=>'current password doesn\'t match'];
        }
    }
    
    protected function profile_updateFunction(Request $req){
        $this->modification('Admin.ProfileController');
        $messages = [
            'required'=>'The :attribute field is required'
        ];

        $Validator = Validator::make(
        $req->only('name','email','phone','profile'),
            [
                'name'=> 'required|max:150|string',
                'email' => 'required',
                'phone' => 'required',
                'profile' => 'image|mimes:png,jpg,jpeg|max:1048',//dimensions:min_width=512,min_height=512
            ],
            $messages
        );

        if($Validator->fails()){
            $Response = $Validator->messages();
        }else{
           try{
                
                if($this->_mailcheckExist($req->get('email'))){
                    $Response = ['email'=>'email all ready used, choose diffrent email'];

                }else{
                    
                    if($this->_phonecheckExist($req->get('phone'))){
                        $Response = ['phone'=>'phone number all ready used'];
                        
                    }else{
                        $find = Admin::find(Auth::guard('admin')->user()->id);
                        if(!empty($find)){
                            if(empty($req->file('profile'))){
                                $find->name = $req->get('name');
                                $find->email = $req->get('email');
                                // $find->profile = $req->file('profile')->store('public/profile');
                                $find->phone = $req->get('phone');
                                $find->save();    
                                $Response = ['success_message'=>'Saved'];    
                            }else{
                                if(!in_array(Auth::guard('admin')->user()->profile,['0','1','2','3','4'])){
                                    Storage::disk('profile')->delete(explode('/', Auth::guard('admin')->user()->profile)[2]);
                                }
                                $find->name = $req->get('name');
                                $find->email = $req->get('email');
                                $find->profile = $req->file('profile')->store('public/profile');
                                $find->phone = $req->get('phone');
                                $find->save();
                                $Response = ['success_message'=>'Saved'];    
                            }
                        Auth::guard('admin')->user()->notify(new Other('You have made changes in profile','user','/admin/profile')); 
                        $Response = ['sucess_message'=>'Saved'];    
                        
                    }else{
                            $Response = ['failure_message'=>'Something went wrong going !'];
                        }
                    }
                }
                
                
                
            } catch (\Exception $e) {

                $Response =['error_message'=>$e->getMessage()];
            }
        }
        return redirect(url()->previous())->withErrors($Response)->withInput();   
    }

    protected function _phonecheckExist($phone){
        if(Admin::where('id','!=',Auth::guard('admin')->user()->id)->where('phone',$phone)->exists()){
            return true;
        }else{
            return false;
        }
    }

    protected function _mailcheckExist($email){
        if(Admin::where('id','!=',Auth::guard('admin')->user()->id)->where('email',$email)->exists()){
            return true;
        }else{
            return false;
        }
    }

    protected function deletePhotoFunction(){
        $this->modification('Admin.ProfileController');
        try{
                $find = Admin::find(Auth::guard('admin')->user()->id);
                if(!empty($find)){
                    Storage::disk('profile')->delete(explode('/', Auth::guard('admin')->user()->profile)[2]);
                    $find->profile = array_rand(['0','1'],1);
                    $find->save();
                    $Response = ['success_message'=>'Saved'];    
                    
                }else{
                    $Response = ['failure_message'=>'not found!'];    
                }
                
            // Storage::disk('profile')->delete(explode('/', Auth::guard('admin')->user()->profile)[2]);
            // $Response =['pok'=>'saved'];
        } catch (\Exception $e) {
                $Response =['error_message'=>$e->getMessage()];
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
