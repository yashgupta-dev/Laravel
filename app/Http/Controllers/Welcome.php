<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Common\CommonSettingController;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;

use App\Models\Admin;
use App\Models\User;
use Auth;

use DB;
use App\Models\Hotel;
use App\Models\Country;
use App\Models\Zone;
use App\Models\Room;
use App\Models\Rooms_description;
use App\Models\Rooms_fixedfacilitie;
use App\Models\Rooms_optionfacilitie;
use App\Models\Customerpartner;
use App\Models\Hotelpermission;

class Welcome extends Controller
{
    
    public function index() {
        return view('welcome.index');
    }

    public function about() {
        return view('welcome.about-us');
    }

    public function hotelFunction() {
        return view('welcome.hotel');
    }
    public function hotel_inner_Function($slug= '')
    {
        $exists = $this->_getHotelsDetails($slug);        
        
        if($exists) {      
            
            return view('welcome.hotel-inner',compact('exists'));
        } else {
            abort(404);
        }
    }

    private function _getHotelsDetails($slug) {
        try {
            $result  = Hotel::where('slug',$slug)->first();            
            $data = [];
            if(!empty($result)) {
                $data = [
                    'hotel' => $result,
                    'rooms_types' => $this->getCate($result['id'])
                ];
            }
            return $data;
        } catch (\Exception $e) {
         
        } 
    }

    private function getCate($id = 0) {
        DB::statement("SET SQL_MODE=''");//this is the trick use it just before your query
        $data = DB::table('rooms')
                    ->join('categories','categories.category_id','rooms.room_category')                    
                    ->select('rooms.id','rooms.hotel_id','categories.category_id','categories.name')
                    ->where('rooms.hotel_id',$id)
                    ->groupBy('rooms.room_category')
                    ->get();
        
        $roomdata = [];
        if(!empty($data)) {
            foreach ($data as $key => $value) {
                $roomdata[] = [                    
                    'room_id' => $value->id,
                    'category_id' => $value->category_id,
                    'category_name' => $value->name,
                    'roomsdata' => $this->getRooms($value->category_id)
                ];
            }
        } 
        return $roomdata;
    }
    private function getRooms($id = 0) {        
        $data = Room::where('room_category',$id)
            ->join('rooms_descriptions','rooms_descriptions.room_id','rooms.id')
            ->select('rooms.id','rooms_descriptions.price','rooms_descriptions.image','rooms_descriptions.name','rooms_descriptions.adult','rooms_descriptions.child')->get();      

            $roomdata = [];
            if(!empty($data)) {
                foreach ($data as $key => $value) {
                    $roomdata[] = [                    
                        'price' => $value->price,
                        'image' => $value->image,
                        'name' => $value->name,
                        'adult' => $value->adult,
                        'child' => $value->child,
                        'fixed_facility' => $this->getFixedFacility($value->id),
                        'optional_facility' => $this->getOptionalFacility($value->id)
                    ];
                }
            } 
            return $roomdata;
    }

    private function getFixedFacility($id = 0) {
        return Rooms_fixedfacilitie::
            join('fixedfacilities','fixedfacilities.id','rooms_fixedfacilities.facility_id')
            ->select('fixedfacilities.faciltie_name','fixedfacilities.faciltie_icon')
            ->where('rooms_fixedfacilities.room_id',$id)                    
            ->get();
    }

    private function getOptionalFacility($id = 0) {
        return Rooms_optionfacilitie::
                join('optionalfaclities','optionalfaclities.id','rooms_optionfacilities.option_value_id')                    
                ->select('optionalfaclities.optional_facilitie_name','optionalfaclities.optional_facilitie_icon','rooms_optionfacilities.price_prefix','rooms_optionfacilities.price')
                ->where('rooms_optionfacilities.room_id',$id)
                ->get();
    }

    public function Book_Now_Function()
    {
        return view('welcome.book-now');
    }
    public function hotel_list_function()
    {
        return view('welcome.hotel-list');
    }
    public function member_Function()
    {
        return view('welcome.member');
    }

}
