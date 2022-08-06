<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Notifications\User\Account as AccountMail;
use App\Models\Account;

use App\Notifications\Other as Other;
use App\Models\User;
use App\Models\Role;
use Auth;

class AccountController extends Controller
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
        $this->middleware('access:User.AccountController');
        $this->per_page = empty(config('settings.config_pagination')) ? 10 : config('settings.config_pagination');
    }

    /**
     * Show the application Account.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    protected function accountForm(){
        $data = $this->_fetchAccounts(Auth::user()->id);
        return view('user.pages.general.accounts',compact('data'));
    }

    protected function _fetchAccounts($id){
        $out='';
        
        $data = Account::where('user_id',$id)->select('id','default','bank_name','account_no','account_ifsc')->get();
        if(count($data) > 0){
            foreach($data as $row){
            $rand = rand(0,9);
            $out.='
            <div class="col-md-3 grid-margin stretch-card">
            <div class="card" style="background-image:linear-gradient(to right, #0000006b,#0006),url('.asset('logo/pattern/pattern_'.$rand.'.png').'); border-radius: 12px;     background-size: cover;">
                    <div class="card-body">
                        <div>
                            <label for="" class="text-white font-weight-bold">Bank : </label>
                            <span class="font-weight-bold text-white h6">'.$row['bank_name'].'</span>
                        </div>
                        <div>
                            <label for="" class="text-white font-weight-bold">A/C No: </label>
                            <span class="font-weight-bold text-white h6">'.$row['account_no'].'</span>
                        </div>
                        <div class="border-top mt-1 mb-1"></div>
                        <div>
                            <label for="" class="font-weight-bold text-white">IFSC CODE: </label>
                            <label class="ml-1 text-white">'.$row['account_ifsc'].'</label>
                        </div>
                        <div>
                            <div class="d-flex justify-content-center bg-light pt-1">
                                <a href="'.route('home.delete').'?id='.$row['id'].'" class=""><i class="fa fa-trash-alt text-danger"></i></a>
                                <!--a href="" class="ml-3"><i class="fa fa-edit text-info"></i></a-->
                                <form class="ml-3" method="post" action="'.route('home.default_set').'" id="form_default">
                                    '.csrf_field().'
                                    <div class="custom-control custom-switch">
                                        <input type="hidden" name="default_id" value="'.$row['id'].'">
                                        <input  name="default" id="default'.$row['id'].'" value="1"'; if($row['default'] == 1) $out.='checked'; $out.=' type="radio" class="custom-control-input">
                                        <label class="custom-control-label" for="default'.$row['id'].'">'; if($row['default'] == 1) $out.=' Default'; else $out.='No Default'; $out.='</label>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            ';
            }
            $out.='
            <div class="col-md-3 grid-margin stretch-card">
            <a href="'.route('home.account.add').'">
                <div class="card" style="border-radius: 12px;">
                    <div class="card-body">
                        <div>
                            <div class="d-flex justify-content-center">
                                <i class="fa fa-plus-circle" id="add_icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
                </a>
            </div>
                
            ';
        }else{
            $out.='
            <div class="col-md-3 grid-margin stretch-card">
            <a href="'.route('home.account.add').'">
                <div class="card" style="border-radius: 12px;">
                    <div class="card-body">
                        <div>
                            <div class="d-flex justify-content-center">
                                <i class="fa fa-plus-circle" id="add_icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
                </a>
            </div>
                
            ';
        }

        return $out;
    }

    protected function accountAddForm(){
        return view('user.pages.general.add_account');
    }

    protected function account_add_function(Request $req){
        $this->modification('User.AccountController');
        $messages = [
            'required'=>'The :attribute field is required'
        ];

        $Validator = Validator::make(

            $req->only('bank_name','branch','account_name','account_no','confirm_account','ifsc'),
            
            [
                'bank_name' =>'required|string',
                'branch' =>'required|max:70',
                'account_name' =>'required|string|max:70',
                'confirm_account' =>'max:20',
                'account_no' =>'required|numeric|same:confirm_account|unique:accounts',
                'ifsc' =>'required|max:11',
            ],

            $messages
        );

        if($Validator->fails()){

            $Response =$Validator->messages();

        }
        else{
            try{

                $ac= new Account([
                    'user_id'=>Auth::user()->id,
                    'account_name'=>$req->get('account_name'),
                    'account_branch'=>$req->get('branch'),
                    'account_no'=>$req->get('account_no'),
                    'account_ifsc'=>$req->get('ifsc'),
                    'bank_name'=>$req->get('bank_name'),
                ]);

                $ac->save();
                Auth::user()->notify(new AccountMail($req));    
                event(new \App\Events\Dashboard());
                $Response = ['ok'=>'account saved successfully'];

            } catch (\Exception $e) {

                $Response =['er'=>$e->getMessage()];
            }
        }
        return response()->json($Response,200);
    }

    protected function _checkIsDefault($id,$user){
        return Account::where("id",$id)->where('user_id',$user)->where('default','1')->first('id');
    }

    protected function setDefaultAccount(Request $req){

        $this->modification('User.AccountController');
        $messages = [
            'required'=>'The :attribute field is required'
        ];

        $Validator = Validator::make(
        $req->only('default_id','default'),
            [
                'default_id'=> 'required|numeric',
                'default'=> 'required|numeric',
            ],
            $messages
        );

        if($Validator->fails()){
            $Response = $Validator->messages();
        }else{
           try{
                
                $up = Account::find($req->get('default_id'));
                if(empty($up)){
                    $Response = ['default_id'=>'Nothing to found to set default !'];
                }else{
                    $dat = Account::where('default','1')->select('id')->first('id');
                    if(!empty($dat)){
                        $exist = Account::find($dat->id);
                        $exist->default = '0';
                        $exist->save();
                    }

                    $up->default = '1';
                    $up->save();
                    $Response = ['success_message'=>$up->bank_name .' set as default account'];
                }
                
            } catch (\Exception $e) {

                $Response =['errro_message'=>$e->getMessage()];
            }
        }
        return redirect(url()->previous())->withErrors($Response)->withInput();
    }

    protected function deleteAccountData(){
        $this->modification('User.AccountController');
        if(Request()->id){
            
                if($this->_checkIsDefault(Request()->id,Auth::user()->id)){
                    $Response =['failure_message'=>'We can\t delete this account! first you set new default account, Then try?'];    
                }else{
                    Account::where('id',Request()->id)->delete();
                    $Response =['success_message'=>'Account has been deleted'];    
                }
            
        }else{
            $Response =['failure_message'=>'something went wrong!'];
        }

        return redirect(url()->previous())->withErrors($Response)->withInput();
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
