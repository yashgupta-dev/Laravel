<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Hotel extends Model
{
    use HasFactory;
    protected $fillable = [
        'hotel_name',
        'hotel_short_desc',
        'hotel_desc',
        'hotel_meta',
        'hotel_meta_tag',
        'hotel_keywords',
        'hotel_address',
        'hotel_website',
        'hotel_email',
        'hotel_phone',
        'hotel_fax',
        'image',
        'gallery',
        'checkin',
        'checkout',
        'country',
        'city',
        'latitude',
        'longitude',
        'status',
        'slug',
        'custom_fields',

    ];
    
    protected $guarded = [
        'hotel_website',
        'hotel_email',
        'hotel_phone',
        'hotel_fax',
        'hotel_meta',
        'hotel_meta_tag',
        'hotel_keywords',
        'slug',
    ];
    protected $hidden = [];
    
    public $timestamps = true;

    protected function getOwner(){
        return $this->hasOne(Customerpartner::class, 'hotel_id','id');
    }
}
