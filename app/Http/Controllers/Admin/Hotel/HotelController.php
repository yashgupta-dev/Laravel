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
use App\Models\User;
use App\Models\Role;
use Auth;

use DB;
use App\Models\Hotel;
use App\Models\Country;
use App\Models\Zone;
use App\Models\Customerpartner;
use App\Models\Hotelpermission;

class HotelController extends Controller
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
        $this->middleware('masteraccess:Admin.Hotel.HotelController');
        $this->per_page = empty(config('settings.config_pagination')) ? 10 : config('settings.config_pagination');
    }

    /**
     * Show the Admin Profile.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $data = $this->getHotelList();
        return view('admin.pages.hotel.hotel-list',compact('data'));
    }
    
    private function getHotelList(){
        try {
            return DB::table('hotels')
                            ->join('customerpartners','customerpartners.hotel_id','hotels.id')                            
                            ->join('users','users.id','customerpartners.customer_id')                            
                            ->select('hotels.*','users.name')
                            ->orderBy('hotels.id','desc')
                            ->paginate($this->per_page);
        } catch (\Exception $e) {
            
        }
        
    }
    

    public function hotelAddForm() {
        $data = [
            'hotel_title' => 'Hotel Add',
            'edit' => false,
            'route' => route('admin.hotel.add'),
            'countrys'=> $this->_getCountryList()
        ];
        return view('admin.pages.hotel.hotel-add-form',compact('data'));
    }

    protected function _getCountryList(){
        try {
            return Country::where('status','1')->select('id','name','iso_code_2')->get();
        } catch (\Exception $e) {
            
        }
    }

    protected function hotelAdd(Request $request){        
        $this->modification('Admin.Hotel.HotelController');
        $messages = [
            'required'=>'The :attribute field is required'
        ];

        $Validator = Validator::make(
        $request->only('hotel_name','country','hotel_short_desc','city','latitude','longitude','hotel_desc','hotel_meta','hotel_meta_tag','hotel_keywords','hotel_address','hotel_website','hotel_email','hotel_phone','hotel_fax','hotel_main_img','gallery','bookingcheckin','bookingcheckout','status','custom_fields','assigne_id'),
            [
                'assigne_id' => 'required|numeric|exists:users,id',
                'hotel_name' => 'required|regex:/^([A-Za-z0-9\s\-\+\(\)]*)$/ ',
                'hotel_desc' => 'required',
                'hotel_short_desc' => 'required|max:200',
                'hotel_meta' => 'required|max:100|regex:/^([A-Za-z0-9\s\-\+\(\)]*)$/',
                'hotel_meta_tag' => 'nullable|max:170',
                'hotel_keywords' => 'nullable|170',
                'hotel_address' => 'required',
                'hotel_website' => 'nullable|url',
                'hotel_email' => 'required|string|email|unique:hotels',
                'hotel_phone' => 'required|numeric|regex:/^([0-9\s\-\+\(\)]*)$/|unique:hotels',
                'hotel_fax' => 'nullable',
                'hotel_main_img'  => 'nullable|file|mimes:png,jpg,jpeg',
                'gallery.*'  => 'nullable|file|mimes:png,jpg,jpeg',
                'bookingcheckin'  => 'date_format:H:i|required',
                'bookingcheckout'  => 'required|date_format:H:i|after:bookingcheckin',
                'country' => 'required|numeric|exists:country,id',
                'city' => 'required|numeric|exists:zones,id',
                'latitude' => 'required',
                'longitude' => 'required',
                'status' => 'required|in:0,1',
                'custom_fields' => '',
            ],
            $messages
        );

        if($Validator->fails()){
            $Validator->getMessageBag()->add('success', true);            
            $Response = $Validator->messages();
            
        }else{
           try{
                
                $hotel = new Hotel([
                    'hotel_name'        => $request->get('hotel_name'),
                    'hotel_desc'        => $request->get('hotel_desc'),
                    'hotel_short_desc'        => $request->get('hotel_short_desc'),
                    'hotel_meta'        => $request->get('hotel_meta'),
                    'hotel_meta_tag'    => $request->get('hotel_meta_tag'),
                    'hotel_keywords'    => $request->get('hotel_keywords'),
                    'hotel_address'     => $request->get('hotel_address'),
                    'hotel_website'     => $request->get('hotel_website'),
                    'hotel_email'       => $request->get('hotel_email'),
                    'hotel_phone'       => $request->get('hotel_phone'),
                    'hotel_fax'         => $request->get('hotel_fax'),
                    'image'    => !empty($request->file('hotel_main_img')) ? $request->file('hotel_main_img')->store('public/hotel/'.$request->get('hotel_name')) : '',
                    // 'gallery'           => $request->get(''),
                    'checkin'           => $request->get('bookingcheckin'),
                    'checkout'          => $request->get('bookingcheckout'),
                    'country'            => $request->get('country'),
                    'city'            => $request->get('city'),
                    'latitude'            => $request->get('latitude'),
                    'longitude'            => $request->get('longitude'),
                    'status'            => $request->get('status'),
                    'slug'            => preg_replace('/\s+/', '_', strtolower($request->get('hotel_name'))),
                    'custom_fields'     => json_encode($request->get('custom_fields')),
                ]);
                
                $hotel->save();

                $images = [];
                if(!empty($request->file('hotel_gallery'))) {
                    for($i = 0; $i < count($request->file('hotel_gallery')); $i++){
                        $images[] = [$request->file('hotel_gallery')[$i]->store('public/hotel/'.$request->get('hotel_name').'')];
                    }
                    
                    $find = Hotel::find($hotel->id);
                    if(!empty($find)){
                        $find->gallery = json_encode($images);
                        $find->save();
                    }
                }

                $customerpartner = new Customerpartner([
                    'customer_id'=>$request->get('assigne_id'),
                    'hotel_id' => $hotel->id,
                    'permission'=>json_encode(['access'=>[],'modify'=>[]])
                ]);

                $menu = new Hotelpermission([
                    'customer_id'=>$request->get('assigne_id'),
                    'permission'=>json_encode(['menues'=>['hotel_manger','rooms_manager','facilities','optional_facilities','booking']])
                ]);
                $menu->save();
                
                $customerpartner->save();
                $userEmail = User::where('id',$request->get('assigne_id'))->select('name')->first();
                $mailData = [
                    'name'=> !empty($userEmail) ? $userEmail['name'] : $request->get('hotel_name'),                    
                    'subject'=>'Hotel Registered',
                    'message'=>'Hurray! you hotel has been created '.$request->get('hotel_name').'',                                   
                ];
                
                $user = $this->_userNotify($request->get('assigne_id'));
                $user->notify(new Other('Hurray! your hotel has been created ( '.$request->get('hotel_name').' )','thumbs-up',route('home'),true,$mailData)); 

                $Response = ['success'=>false,'message'=>'Your hotel has been registerd.','color'=>'success','ss'=>'Hurray!'];
            } catch (\Exception $e) {
                $Response = ['success'=>true,'alert-error'=>true,'message'=>$e->getMessage(),'color'=>'warning','ss'=>'Warning!'];
            }
        }

        return response()->json($Response);

    }

    private function _userNotify($id){
        return User::find($id);
    }

    public function hotelEditForm($id) {
        if($this->_checkIdExists($id)){
            $data = [
                'hotel_title' => 'Hotel Edit',
                'edit' => true,
                'id'=>$id,
                'route' => route('admin.hotel.edit'),
                'countrys'=> $this->_getCountryList()
            ];
            return view('admin.pages.hotel.hotel-add-form',compact('data'));
        } else {
            return redirect(url()->previous());   
        }
    }

    private function _checkIdExists($id) {
        return Hotel::where('id',$id)->exists();
    }

    protected function HotelFetchEditForm(Request $request){
        $messages = [
            'required'=>'The :attribute field is required'
        ];

        $Validator = Validator::make(
        $request->only('id'),
            [
                'id' => 'required|numeric|exists:hotels,id',
            ],
            $messages
        );

        if($Validator->fails()){
            $Validator->getMessageBag()->add('success', true);        
            $Response = $Validator->messages();            
        }else{
           try{ 

            // $data =  Hotel::where('id',$request->get('id'))->get();
            $data =  DB::table('hotels')
                    ->join('customerpartners','customerpartners.hotel_id','hotels.id')                            
                    ->join('users','users.id','customerpartners.customer_id')                            
                    ->select('hotels.*','users.id as assigne_id','users.name as assigne')
                    ->get();
                    
            $Response = ['success'=>false,'message'=>$data];
            } catch (\Exception $e) {
                $Response = ['success'=>true,'message'=>$e->getMessage()];
            }

        }
        return response()->json($Response);
    }
    protected function autocompleteFunction(Request $request){
        $json = array();
        
		// if (isset($request->filter_name)) {
			$filter_data = array(
				'filter_name' => isset($request->filter_name) ? $request->filter_name : '',
				'sort'        => 'name',
				'order'       => 'ASC',
				'start'       => 0,
				'limit'       => 5
			);
            
			$results = $this->_getAssignName($filter_data);
            
            if(count($results) > 0) {
                foreach ($results as $result) {
                    $path = '';
                    if(!in_array($result->profile,['0','1','2','3','4'])){
                        $path = asset('storage').'/profile/'.explode('/',$result->profile)[2];
                    } else {
                        $path =  asset('logo').'/'.$result->profile.'.png';
                    }                                                
                    $json[] = array(
                        'user_id' => $result->id,
                        'name'        => $result->name,
                        'email' => $result->email,
                        'image' => $path
                    );
                }
            // }
		}

		$sort_order = array();

		foreach ($json as $key => $value) {
			$sort_order[$key] = $value['name'];
		}

		array_multisort($sort_order, SORT_ASC, $json);
        return response()->json($json,200);
    }

    private function _getAssignName($data = array()){
        $sql = "SELECT `name`,`id`,`email`,`profile` From users";
		if (!empty($data['filter_name'])) {
			$sql .= " WHERE name LIKE '" . $data['filter_name'] . "%'";
		}
		
        $sort_data = array(
			'name',
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}
        
		$query = DB::SELECT($sql);

		return $query;
    }

    protected function getListOfCitys(Request $request){
        
        $messages = [
            'required'=>'The :attribute field is required'
        ];

        $Validator = Validator::make(
        $request->only('country_id'),
            [
                'country_id' => 'required|numeric|exists:zones,country_id',
            ],
            $messages
        );

        if($Validator->fails()){
            $Validator->getMessageBag()->add('success', true);        
            $Response = $Validator->messages();
            
        }else{
           try{ 

            $data =  Zone::where('country_id',$request->get('country_id'))->where('status','1')->select('id','name')->get();
            $Response = ['success'=>false,'message'=>$data];
            } catch (\Exception $e) {
                $Response = ['success'=>true,'message'=>$e->getMessage()];
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
