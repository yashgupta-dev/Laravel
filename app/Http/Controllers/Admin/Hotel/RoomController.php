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

use App\Models\Hotel;
use App\Models\Customerpartner;
use App\Models\Hotelpermission;
use App\Models\Room;
use App\Models\Rooms_description;
use App\Models\Rooms_fixedfacilitie;
use App\Models\Rooms_optionfacilitie;
use App\Models\Optionalfaclitie;
use App\Models\Fixedfacilitie;
use App\Models\Categorie;
use DB;

class RoomController extends Controller
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
        $this->middleware('masteraccess:Admin.Hotel.RoomController');
        $this->per_page = empty(config('settings.config_pagination')) ? 10 : config('settings.config_pagination');
    }

    /**
     * Show the Admin Profile.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $data = $this->getRoomlist();

        return view('admin.pages.hotel.room-list',compact('data'));
    }

    private function getRoomlist() {
        try {
            return DB::table('rooms')
                            ->join('rooms_descriptions','rooms_descriptions.room_id','rooms.id')
                            // ->join('rooms_fixedfacilities','rooms_fixedfacilities.room_id','rooms_descriptions.id')
                            // ->join('rooms_optionfacilities','rooms_optionfacilities.room_id','rooms_descriptions.id')
                            ->join('hotels','hotels.id','rooms.hotel_id')
                            ->join('customerpartners','customerpartners.hotel_id','hotels.id')
                            ->join('users','users.id','customerpartners.customer_id')
                            ->select('hotels.hotel_name','rooms_descriptions.*','users.name as username')
                            // ->orderBy('hotels.id','desc')
                            ->paginate($this->per_page);
        } catch (\Exception $e) {
            
        }
    }

    public function roomAddForm() {
        $data = ['category'=> $this->categoryList()];
        return view('admin.pages.hotel.room_add',compact('data'));
    }

    private function categoryList() {
        try {
            return Categorie::where('status','1')->select('name','category_id')->get();
        } catch (\Exception $e) {
            
        }
    }
    public function roomAddFunction(Request $request) {
        $this->modification('Admin.Hotel.RoomController');
        $messages = [
            'required'=>'The :attribute field is required'
        ];

        $Validator = Validator::make(
        $request->only('name','editordata','room_category','meta','tag','keywords','price','qty','room_prefix','booking_prefix','adult','child','booking_from','booking_to','status','product_option_value','hotel_id','product_attribute','hotel_main_img','hotel_gallery'),
            [
                'name' => 'required|regex:/^([A-Za-z0-9\s\-\+\(\)]*)$/',
                'editordata' => 'nullable',
                'room_category' => 'required|exists:categories,category_id',
                'meta' => 'required|string|max:170|regex:/^([A-Za-z0-9\s\-\+\(\)]*)$/ ',
                'price' => 'required|numeric|regex:/^([0-9\s\-\+\(\)]*)$/',
                'qty' => 'nullable|numeric|regex:/^([0-9\s\-\+\(\)]*)$/',
                'room_prefix' => 'nullable|string|regex:/^([A-Za-z\s\-\+\(\)]*)$/ ',
                'booking_prefix' => 'nullable|string|regex:/^([A-Za-z0-9\s\-\+\(\)]*)$/ ',
                'adult' => 'nullable|numeric|regex:/^([0-9\s\-\+\(\)]*)$/',
                'child' => 'nullable|numeric|regex:/^([0-9\s\-\+\(\)]*)$/',
                'booking_from' => 'required|date|required',
                'booking_to' => 'required|date|after:booking_from',
                'status' => 'in:0,1',
                'hotel_id.*' => 'required|numeric|exists:hotels,id',
            ],
            $messages
        );

        if($Validator->fails()){
            $Validator->getMessageBag()->add('success', true);            
            $Response = $Validator->messages();
            
        }else{
           try{
            
            $roomadd = new Room([
                'hotel_id' => $request->get('hotel_id'),
                'room_category' =>$request->get('room_category'),
            ]);
            $roomadd->save();

            $hotel_name = Hotel::select('hotel_name')->where('id',$request->get('hotel_id'))->first(); 
            $room_id = $roomadd->id;
            $room_data = new Rooms_description([
                'room_id' => $room_id,
                'name' => $request->get('name'),
                'description' => $request->get('editordata'),
                'meta' => $request->get('meta'),
                'price' => $request->get('price'),
                'quantity' => $request->get('qty'),
                'room_prefix' => $request->get('room_prefix'),
                'booking_prefix' => $request->get('booking_prefix'),
                'adult' => $request->get('adult'),
                'child' => $request->get('child'),
                'booking_from' => $request->get('booking_from'),
                'booking_till' => $request->get('booking_to'),
                'image' => !empty($request->file('hotel_main_img')) ? $request->file('hotel_main_img')->store('public/hotel/'.$hotel_name['hotel_name'].'/rooms') : '',
                'status' => $request->get('status'),
                'slug'            => preg_replace('/\s+/', '_', strtolower($request->get('name'))),
            ]);

            $room_data->save();

            $images = [];
            if(!empty($request->file('hotel_gallery'))) {
                for($i = 0; $i < count($request->file('hotel_gallery')); $i++){
                    $images[] = [$request->file('hotel_gallery')[$i]->store('public/hotel/'.$hotel_name['hotel_name'].'/rooms')];
                }
                
                $find = Rooms_description::find($room_data->id);
                if(!empty($find)){
                    $find->image_bulk = json_encode($images);
                    $find->save();
                }
            }

            $fixed = [];
            if(!empty($request->get('product_attribute'))) {
                foreach ($request->get('product_attribute') as $key => $value) {
                    $fixed[] = [
                        'room_id' => $room_data->id,
                        'name' => $value['name'],
                        'facility_id' => $value['attribute_id'],
                        'description' => $value['product_attribute_description'],
                    ];
                }
                Rooms_fixedfacilitie::insert($fixed);
            }

            $option = [];
            if(!empty($request->get('product_option_value'))) {
                foreach ($request->get('product_option_value') as $key => $value) {
                    $option[] = [
                        'room_id' => $room_data->id,
                        'price_prefix' => $value['price_prefix'],
                        'price' => $value['price'],
                        'option_value_id' => $value['option_value_id'],
                        'status' => $value['status'],
                    ];
                }
                Rooms_optionfacilitie::insert($option);
            }
            
            $Response = ['success'=>false,'message'=>'Your room has been created.','color'=>'success','ss'=>'Hurray!','redirect'=>route('admin.hotel.room')];

            } catch (\Exception $e) {
                $Response = ['success'=>true,'error_alert'=>true,'message'=>$e->getMessage(),'color'=>'warning','ss'=>'Warning!'];
            }
        }

        return response()->json($Response);
    }
    protected function attributeAutocomplete(Request $request){
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
                    $json[] = array(
                        'attribute_id'=> $result->id,
                        'name' => $result->name,
                        'attribute_group' => 'Room Amenities',
                    );
                }
            }
		// }

		$sort_order = array();

		foreach ($json as $key => $value) {
			$sort_order[$key] = $value['name'];
		}

		array_multisort($sort_order, SORT_ASC, $json);
        return response()->json($json,200);
    }

    private function _getAssignName($data = array()){
        $sql = "SELECT `faciltie_name` as `name`,`id` From fixedfacilities";
		if (!empty($data['filter_name'])) {
			$sql .= " WHERE faciltie_name LIKE '" . $data['filter_name'] . "%'";
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
    // angular data;
    protected function getAutoloadData() {
        return [
            'hotellist' => $this->_getHotelList(),
            'optionfacility' => $this->_getOptinalFacilityList(),
        ];
    }

    private function _getOptinalFacilityList() {
        return Optionalfaclitie::get();
    }

    private function _getHotelList(){
        return Hotel::select('id','hotel_name','status')->get();
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
