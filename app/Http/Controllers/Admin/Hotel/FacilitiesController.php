<?php

namespace App\Http\Controllers\Admin\Hotel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Storage;

use App\Notifications\Other as Other;
use App\Models\Admin;
use App\Models\Role;
use Auth;

use App\Models\Fixedfacilitie;

class FacilitiesController extends Controller
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
        $this->middleware('masteraccess:Admin.Hotel.FacilitiesController');
        $this->per_page = empty(config('settings.config_pagination')) ? 10 : config('settings.config_pagination');
    }

    /**
     * Show the Admin Profile.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $data = $this->getList();
        return view('admin.pages.hotel.Hotel_fixed_facilities',compact('data'));
    }

    private function getList() {
        return Fixedfacilitie::paginate($this->per_page);
    }
    public function facilitiesFunction() {
        return view('admin.pages.hotel.Hotel_add_fixed_facilities');
    }

    protected function facilitiesFunctionAdd(Request $request) {
        $this->modification('Admin.Hotel.FacilitiesController');
        $messages = [
            'required'=>'The :attribute field is required'
        ];

        $Validator = Validator::make(
        $request->only('name','icon','status'),
            [
                'name' => 'required|string|max:80',
                'hotel_main_img'  => 'file|mimes:png,jpg,jpeg',
                'status' => 'required|in:0,1',
            ],
            $messages
        );

        if($Validator->fails()){
            $Validator->getMessageBag()->add('error', true);            
            $Response = $Validator->messages();
            
        }else{
           try{
                $save = new Fixedfacilitie([
                    'faciltie_name' => $request->get('name'),
                    'faciltie_icon' => !empty($request->file('icon')) ? $request->file('icon')->store('public/hotel/fixedfacilities') : '',
                    'faciltie_status'=> $request->get('status'),
                ]);

                $save->save();
                $Response = ['success'=>true,'message'=>'Fixed facilitie has been added.','color'=>'success','ss'=>'Hurray!','redirect'=>route('admin.hotel.facilities')];
            } catch (\Exception $e) {
                $Response = ['success'=>true,'message'=>$e->getMessage(),'color'=>'warning','ss'=>'Warning!'];
            }
        }

        return response()->json($Response);
    }

    protected function facilitiesFunctionDelete(Request $request) {
        $this->modification('Admin.Hotel.FacilitiesController');
        
        $messages = [
            'required'=>'The :attribute field is required'
        ];

        $Validator = Validator::make(
        $request->only('checkbox'),
            [
                'checkbox.*' => 'required|numeric|exists:fixedfacilities,id',
            ],
            $messages
        );

        if($Validator->fails()){
            $Validator->getMessageBag()->add('error', true);
            // $Validator->getMessageBag()->add('message', 'Atleast select one record to delete');
            // $Validator->getMessageBag()->add('color', 'warning');
            // $Validator->getMessageBag()->add('ss', 'Warning');
            $Response = $Validator->messages();
            
        }else{
           try{
                if(count($request->get('checkbox')) > 0) {
                    for ($i=0; $i < count($request->get('checkbox')) ; $i++) { 
                        $find = Fixedfacilitie::find($request->get('checkbox')[$i]);
                        if(!empty($find->faciltie_icon)) {
                            Storage::disk('hotelFacilities')->delete(explode('/',$find->faciltie_icon)[3]);
                        }
                        $find->delete();        
                    }
                    $Response = ['success'=>true,'message'=>'Record deleted successfully','color'=>'info','ss'=>'Hurray!','redirect'=>route('admin.hotel.facilities')];    
                } else {
                    $Response = ['success'=>true,'message'=>'Atleast select one record to delete','color'=>'info','ss'=>'Warning!'];
                }

            } catch (\Exception $e) {

                $Response = ['success'=>true,'message'=>$e->getMessage(),'color'=>'warning','ss'=>'Warning!'];
            }
        }

        // return redirect(url()->previous())->withErrors($Response)->withInput();   
        return response()->json($Response);
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
