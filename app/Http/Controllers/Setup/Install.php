<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PayUService\Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\Site;
use App\Models\Admin;
use App\Models\Role;
use DB;

class Install extends Controller
{
    //
    public function setupRun(){
        return view('setup.install');   
    }
    public function setupFinsihLast(){
        return view('setup.finish');      
    }

    protected function createUserAdmin(Request $req){
        $messages = [
            'required'=>'The :attribute field is required'
        ];

        $Validator = Validator::make(
        $req->only('name','email','phone','password','password_confirmation'),
            [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'phone' => 'required|numeric|digits:10|regex:/^([0-9\s\-\+\(\)]*)$/|unique:users',
                'password' => 'required|string|min:8|confirmed',
                
            ],
            $messages
        );

        if($Validator->fails()){
            $Response = $Validator->messages();
        }else{
           try{
               
               $data = new Admin([
                    'name' => $req->get('name'),
                    'email' => $req->get('email'),
                    'phone' => $req->get('phone'),
                    'profile' => array_rand(['0','1'],1),
                    'password' => Hash::make($req->get('password')),
                ]);
               
                $data->save();
                $getRoleAdmin = Role::where('name','Administrator')->first();
                DB::table('admin_role')->insert(['role_id'=>$getRoleAdmin->id,'user_id'=>$data->id]);
                DB::statement("CREATE TABLE `category_path` (
                    `category_id` int(11) NOT NULL,
                    `path_id` int(11) NOT NULL,
                    `level` int(11) NOT NULL
                  ) ENGINE=MyISAM DEFAULT CHARSET=utf8;");
                DB::statement("ALTER TABLE `category_path` ADD PRIMARY KEY (`category_id`,`path_id`);");
                DB::statement("INSERT INTO `settings` (`code`, `key`, `value`, `serialized`, `created_at`, `updated_at`) VALUES
                    ('config', 'config_profile_edit', '1', 0),
                    ('config', 'config_password_edit', '0', 0),
                    ('config', 'config_two_way_authentication', '0', 0),
                    ('config', 'config_other_devices', '0', 0),
                    ('config', 'config_ticket_support_panel', '0', 0);
                ");
                // $makeName = explode(' ', $req->get('name'))[0];
                // $team = new Team([
                //     'user_id' => $data->id,
                //     'name' => $makeName.'\'s Team',
                //     'personal_team' => 1,
                // ]);

                // $team->save();

                // $find = User::find($data->id);
                // $find->current_team_id = $team->id;
                // $find->save();


               $Response = ['ok'=>'setup installed successfully!'];
            } catch (\Exception $e) {

                $Response =['er'=>$e->getMessage()];
            }
        }
         return redirect(url()->previous())->withErrors($Response)->withInput();
    }

    protected function setupInstallFunctionPage(Request $req){
        $messages = [
            'required'=>'The :attribute field is required'
        ];

        $Validator = Validator::make(
        $req->only('title','favicon','logo'),
            [
                'title'=> 'required|max:70',
                'favicon' => 'required|image|mimes:png,jpg,svg,jpeg|max:1048',
                'logo' => 'required|image|mimes:png,jpg,jpeg,svg|max:1048',
            ],
            $messages
        );

        if($Validator->fails()){
            $Response = $Validator->messages();
        }else{
           try{
                $folder = Storage::makeDirectory('public/logo/'.$req->get('domain'));
                $find = Site::where('panelId',0)->first();
                if(!empty($find)):
                    $Response = ['favicon'=>'setup installed success fully!'];
                    if(isset($find->logo)):
                        $path = explode('/',$find->logo)[3];
                        Storage::disk('logo')->delete($path);
                    endif;
                        if(isset($find->favicon)):
                            $path = explode('/',$find->favicon)[4];
                            Storage::disk('favicon')->delete($path);
                        endif;
                        $find->title = $req->get('title');
                        $find->logo = $req->file('logo')->store('public/logo/0');
                        $find->favicon = $req->file('favicon')->store('public/logo/0/favicon');
                        $find->save();
                    else:
						$f = new Site([
                            'panelId' => 0,
                            'title' => $req->get('title'),
                            'logo' => $req->file('logo')->store('public/logo/0'),
                            'favicon' => $req->file('favicon')->store('public/logo/0/favicon'),
                        ]);

                        $f->save();
                        
                    endif;
               
               $Response = ['ok'=>'Setup installed successfully!'];
            } catch (\Exception $e) {

                $Response =['er'=>$e->getMessage()];
            }
        }
        return redirect(url()->previous())->withErrors($Response)->withInput();
    }
}
