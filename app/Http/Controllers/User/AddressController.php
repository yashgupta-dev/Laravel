<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Notifications\User\Address as AddressMail;
use App\Models\Addre;

use App\Notifications\Other as Other;
use App\Models\User;
use App\Models\Role;
use Auth;

class AddressController extends Controller
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
        $this->middleware('access:User.AddressController');
        $this->per_page = empty(config('settings.config_pagination')) ? 10 : config('settings.config_pagination');
    }

    /**
     * Show the application Address.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    protected function addressForm(){
        $data = $this->_fetchAddress(Auth::user()->id);
        return view('user.pages.general.address',compact('data'));
    }

    protected function _fetchAddress($id){
        $out='';
        $data = Addre::where('user_id',$id)->select('*')->get();
        if(count($data) > 0){
            foreach ($data as $row) {
                $rand = rand(0,9);
                $out.='
                <div class="col-md-4 grid-margin stretch-card">
                <div class="card" style="background-image:linear-gradient(to right, #0000006b,#0006),url('.asset('logo/pattern/pattern_'.$rand.'.png').'); border-radius: 12px;     background-size: cover;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 text-white">
                                <span class="d-flex justify-content-center"><i class="fas fa-map-marked-alt fa-3x"></i></span>
                                <div class="d-flex h5 mt-1 ">
                                    <span class="ml-2 font-weight-bold">';
                                    if(isset($row['address_1'])) {
                                        $out.=$row['address_1'].', ';
                                    }
                                    if(isset($row['address_2'])) {
                                        $out.=$row['address_2'].', ';
                                    }
                                    $out.='<br>';
                                    if(isset($row['country'])) {
                                        $out.=$row['country'].', ';
                                    }
                                    if(isset($row['state'])) {
                                        $out.=$row['state'].', ';
                                    }
                                    if(isset($row['city'])) {
                                        $out.=$row['city'].' - ';
                                    }
                                    if(isset($row['postal'])) {
                                        $out.=$row['postal'];
                                    }
                                    $out.='<br>';
                                    if(isset($row['mark'])) {
                                        $out.='Land Mark: '.$row['mark'];
                                    }
                                    
                                    $out.='</span>
                                </div>
                                <div class="mb-2"></div>
                                <div class="d-flex justify-content-between bg-dark pt-1">
                                    <a href="'.route('home.delete_add').'?id='.$row['id'].'" class="ml-3"><i class="fa fa-trash-alt text-danger"></i></a>

                                    <!--a href="#" class="ml-2"><i class="fa fa-edit text-info"></i></a-->

                                    <form class="ml-3 mr-3" method="post" action="'.route('home.default_addr').'" id="form_default'.$row['id'].'">
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
            </div>
                ';
            }
            $out.='
            <div class="col-md-3 grid-margin stretch-card">
                <a href="'.route('home.address.add').'">
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
            <a href="'.route('home.address.add').'">
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

    protected function addressAddForm(){
        return view('user.pages.general.add_address');
    }   

    protected function address_add_function(Request $req){
        $this->modification('User.AddressController');
        $messages = [
            'required'=>'The :attribute field is required'
        ];

        $Validator = Validator::make(

            $req->only('address_line','address_line_two','mark','state','city','postal_code','country'),
            
            [
                'address_line' =>'required|max:80',
                // 'address_line_two' =>'string',
                // 'mark' =>'required|max:40',
                'country' =>'required|string|max:70',
                'state' =>'required|string|max:70',
                'city' =>'required|string|max:70',
                'postal_code' =>'required|numeric',
            ],
            $messages
        );

        if($Validator->fails()){

            $Response =$Validator->messages();

        }
        else{
            try{

                $ac= new Addre([
                    'user_id'=>Auth::user()->id,
                    'address_1'=>$req->get('address_line'),
                    'address_2'=>$req->get('address_line_two'),
                    'land_mark'=>$req->get('mark'),
                    'country'=>$req->get('country'),
                    'state'=>$req->get('state'),
                    'city'=>$req->get('city'),
                    'postal'=>$req->get('postal_code'),
                    
                ]);
                $ac->save();
                Auth::user()->notify(new AddressMail($req));    
                event(new \App\Events\Dashboard());
                $Response = ['ok'=>'address saved successfully'];

            } catch (\Exception $e) {

                $Response =['er'=>$e->getMessage()];
            }
        }
        return response()->json($Response,200);
    }

    protected function _checkIsDefault_add($id,$user){
        return Addre::where("id",$id)->where('user_id',$user)->where('default','1')->first('id');
    }

    protected function setDefaultAddress(Request $req){
        $this->modification('User.AddressController');
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
                
                $up = Addre::find($req->get('default_id'));
                if(empty($up)){
                    $Response = ['default_id'=>'Nothing to found to set default !'];
                }else{
                    $dat = Addre::where('default','1')->select('id')->first('id');
                    if(!empty($dat)){
                        $exist = Addre::find($dat->id);
                        $exist->default = '0';
                        $exist->save();
                    }

                    $up->default = '1';
                    $up->save();
                    $Response = ['success_message'=>'Your address set as default address'];
                }
                
            } catch (\Exception $e) {

                $Response =['error_message'=>$e->getMessage()];
            }
        }
        return redirect(url()->previous())->withErrors($Response)->withInput();
    }

    protected function deleteAddressData(){
        $this->modification('User.AddressController');
        if(Request()->id){
            
                if($this->_checkIsDefault_add(Request()->id,Auth::user()->id)){
                    $Response =['failure_message'=>'We can\t delete this address! first you set new default account, Then try?'];    
                }else{
                    Addre::where('id',Request()->id)->delete();
                    $Response =['success_message'=>'Address has been deleted'];    
                }
        }else{
            $Response =['faliure_message'=>'something went wrong!'];
        }

        return redirect(url()->previous())->withErrors($Response)->withInput();
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
