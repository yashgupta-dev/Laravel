<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
use App\Models\Customerpartner;
use App\Models\Hotelpermission;

class HotelGetController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware(['auth' => 'verified']);
        // $this->middleware('role');
        // $this->middleware('access:User.HomeController');
        $this->per_page = empty(config('settings.config_pagination')) ? 10 : config('settings.config_pagination');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getHotelsCountry()
    {   
        try{
            DB::statement("SET SQL_MODE=''");//this is the trick use it just before your query
            $countrys = DB::table('hotels')
                ->join('country','country.id','hotels.country')
                ->where('hotels.status','1')
                ->select('country.name as country_name','hotels.country as country_id')
                ->groupBy('hotels.country')
                ->orderBy('country.name')
                ->get();
            $data = [];            
            if(count($countrys) > 0){
                $i =1;
                foreach ($countrys as $key) {
                    if($i == 1) {
                        $active = 'active';                        
                    } else {
                        $active = '';
                    }
                    $data[] = [
                        'active_state' => $active,
                        'country_id' => $key->country_id,
                        'country_name'  => $key->country_name,
                        
                    ];
                    $i++;
                }
            }
            $Response = ['success'=>false,'data'=>$data];
        } catch (\Exception $e) {
            $Response = ['success'=>true,'data'=>$e->getMessage()];
        }

        return response()->json($Response,200);
    }

    protected function getHotelsZones($id) {
        try{
            DB::statement("SET SQL_MODE=''");//this is the trick use it just before your query
            $zones = DB::table('hotels')                
                ->join('zones','zones.id','hotels.city')
                ->where('hotels.country',$id)
                ->where('hotels.status','1')
                ->select('zones.name as zone_name','hotels.city as zone_id')
                ->groupBy('hotels.city')
                ->orderBy('zones.name')
                ->get();
            if(count($zones)> 0 ){
                $data = [];
                $i = 1;
                foreach ($zones as $zone) {
                    if($i == 1) {
                        $active = 'active';
                    } else {
                        $active = '';
                    }
                    $data[] = [
                        'active_state' => $active,
                        'zone_id' => $zone->zone_id,
                        'zone_name' => $zone->zone_name,
                        'hotels' => $this->_getHotels($zone->zone_id)
                    ];
                    $i++;
                }
            }
            $Response = ['success'=>false,'data'=>$data];
        } catch (\Exception $e) {
            $Response = ['success'=>true,'data'=>$e->getMessage()];
        }

        return response()->json($Response,200);

    }

    private function _getHotels($id)
    {
        try {

            $hotels = DB::table('hotels')
                        ->where('status','1')
                        ->where('city',$id)
                        ->select('id','hotel_name','hotel_short_desc','hotel_address','image','gallery','checkin','checkout','slug')
                        ->get();
                        $data = [];
            if(count($hotels) > 0) {                
                $villproduct2 = '';
                $villproduct1 = '';
                $i = 0;
                foreach ($hotels as $hotel) {
                    $i++;
                    if($i%2 == 0) {
                        $villproduct2 = '';
                        $villproduct1 = '';            
                    } else {
                        $villproduct2 = 'villproduct2';
                        $villproduct1 = 'villproduct1';        
                    }

                    $data[] = [
                        'side1' => $villproduct2,
                        'side2' => $villproduct1,
                        'hotel_id' => $hotel->id,
                        'hotel_name' => $hotel->hotel_name,
                        'url_hotel_name' => urlencode($hotel->hotel_name),
                        'hotel_address' => $hotel->hotel_address,
                        'image' => !empty($hotel->image) ? !empty(explode('public',$hotel->image)[1]) ? 'storage'.explode('public',$hotel->image)[1] : 'logo/placeholder/placeholder.jpg' : 'logo/placeholder/placeholder.jpg',
                        'gallery' => $this->galleryMaker(json_decode($hotel->gallery,true)),
                        'check_in' => $hotel->checkin,
                        'hotel_short_desc' => $hotel->hotel_short_desc,
                        'check_out' => $hotel->checkout,
                        'slug' => $hotel->slug,
                    ];
                }
            }
            $Response = $data;

        } catch (\Exception $e) {
            // $Response = ['success'=>true,'data'=>$e->getMessage()];
            $Response =$e->getMessage();
        }

        return $Response;
    }

    private function galleryMaker($gallery) {
        $galery = [];
        if(!empty($gallery)) {
            for ($i=0; $i < count($gallery) ; $i++) {
                
                $galery[] = !empty(explode('public',$gallery[$i][0])[1]) ? 'storage'.explode('public',$gallery[$i][0])[1] : 'logo/placeholder/placeholder.jpg';    
            }
        } else {
            $galery[] = 'logo/placeholder/placeholder.jpg';
        }
        return $galery;
    }

    protected function getResultHotelInner($id){

    }
}
