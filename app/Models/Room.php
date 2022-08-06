<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'hotel_id',
        'room_category',
    ];
    
    protected $guarded = [];

    protected $hidden = [];
    
    public $timestamps = true;

    protected function getOptionalFacilties() {
        return $this->hasMany('App\Models\Rooms_description','room_id','id')                    
                    ->join('rooms_optionfacilities','rooms_optionfacilities.room_id','rooms_descriptions.id')      
                    ->join('optionalfaclities','optionalfaclities.id','rooms_optionfacilities.option_value_id')                    
                    ->select('optionalfaclities.optional_facilitie_name','optionalfaclities.optional_facilitie_icon','rooms_optionfacilities.price_prefix','rooms_optionfacilities.price');
    }

    protected function getFixedFacilties() {
        return $this->hasMany('App\Models\Rooms_description','room_id','id')                    
                    ->join('rooms_fixedfacilities','rooms_fixedfacilities.room_id','rooms_descriptions.id')
                    ->join('fixedfacilities','fixedfacilities.id','rooms_fixedfacilities.facility_id')
                    ->select('fixedfacilities.faciltie_name','fixedfacilities.faciltie_icon');
    }

}
