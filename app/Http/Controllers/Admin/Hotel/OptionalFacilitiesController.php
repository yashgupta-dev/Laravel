<?php

namespace App\Http\Controllers\Admin\Hotel;

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

use App\Models\Optionalfaclitie;

class OptionalFacilitiesController extends Controller
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
        $this->middleware('masteraccess:Admin.Hotel.OptionalFacilitiesController');
        $this->per_page = empty(config('settings.config_pagination')) ? 10 : config('settings.config_pagination');
    }

    /**
     * Show the Admin Profile.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $data = $this->getList();
        return view('admin.pages.hotel.optional_facilities',compact('data'));
    }
    private function getList() {
        return Optionalfaclitie::paginate($this->per_page);
    }
    public function optionalFacilitiesFunction(Request $request) {
        $this->modification('Admin.Hotel.OptionalFacilitiesController');
        $messages = [
            'required'=>'The :attribute field is required'
        ];

        $Validator = Validator::make(
        $request->only('option_facilitie','hotel_gallery','sort_order'),
            [
                'option_facilitie.*' => 'required|string|max:80',
                'hotel_gallery.*'  => 'file|mimes:png,jpg,jpeg',
                'sort_order.*' => 'regex:/^([0-9\s\-\+\(\)]*)$/',
            ],
            $messages
        );

        if($Validator->fails()){
            $Validator->getMessageBag()->add('error', true);            
            $Response = $Validator->messages();
            
        }else{
           try{
                if(count($request->get('option_facilitie')) > 0){
                    $data = [];
                    for ($i=0; $i < count($request->get('option_facilitie')); $i++) { 
                        if(empty($request->get('option_value_id')[$i])) {
                            $data[] = [
                                'optional_facilitie_name' => $request->get('option_facilitie')[$i],
                                'optional_facilitie_icon' => !empty($request->file('hotel_gallery')[$i]) ? $request->file('hotel_gallery')[$i]->store('public/hotel/optionfacilities') : '',
                                'optional_facilitie_sort' => $request->get('sort_order')[$i],
                            ];
                        } else {
                            
                            $find = Optionalfaclitie::find($request->get('option_value_id')[$i]);
                            $find->optional_facilitie_name = $request->get('option_facilitie')[$i];
                            if(!empty($request->file('hotel_gallery')[$i]) && !empty($find->optional_facilitie_icon)) {
                                Storage::disk('hotelOption')->delete(explode('/',$find->optional_facilitie_icon)[3]);
                                $find->optional_facilitie_icon = $request->file('hotel_gallery')[$i]->store('public/hotel/optionfacilities');
                            } else {
                                $find->optional_facilitie_icon = !empty($request->file('hotel_gallery')[$i]) ? $request->file('hotel_gallery')[$i]->store('public/hotel/optionfacilities') : $find->optional_facilitie_icon ;
                            }
                            $find->optional_facilitie_sort = $request->get('sort_order')[$i];
                            $find->save();
                        }
                    }
                    Optionalfaclitie::insert($data);
                    $Response = ['success'=>true,'message'=>'Optional facilitie has been added.','color'=>'success','ss'=>'Hurray!','redirect'=>route('admin.hotel.optional.facilities')];
                } else {
                    $Response = ['success'=>true,'message'=>'Please check fill details correctly.','color'=>'warning','ss'=>'Warning!'];
                }
                
            } catch (\Exception $e) {
                $Response = ['success'=>true,'message'=>$e->getMessage(),'color'=>'warning','ss'=>'Warning!'];
            }
        }

        return response()->json($Response);
    }

    protected function optionalFacilitiesDeleteFunction(Request $request) {
        $this->modification('Admin.Hotel.OptionalFacilitiesController');
        $messages = [
            'required'=>'The :attribute field is required'
        ];

        $Validator = Validator::make(
        $request->only('id'),
            [
                'id' => 'required|numeric|exists:optionalfaclities,id',
            ],
            $messages
        );

        if($Validator->fails()){
            $Validator->getMessageBag()->add('error', true);            
            $Response = $Validator->messages();
            
        }else{
           try{
                $find = Optionalfaclitie::find($request->get('id'));
                if(!empty($find->optional_facilitie_icon)) {
                    Storage::disk('hotelOption')->delete(explode('/',$find->optional_facilitie_icon)[3]);
                }
                $find->delete();
                $Response = ['success'=>true,'message'=>'Record deleted successfully','color'=>'info','ss'=>'Hurray!'];

            } catch (\Exception $e) {

                $Response = ['success'=>true,'message'=>$e->getMessage(),'color'=>'warning','ss'=>'Warning!'];
            }
        }

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
