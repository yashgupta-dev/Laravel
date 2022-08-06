<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rooms_description extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'name',
        'description',
        'meta',
        'tag',
        'keyword',
        'price',
        'quantity',
        'room_prefix',
        'booking_prefix',
        'adult',
        'child',
        'booking_from',
        'booking_till',
        'image',
        'image_bulk',
        'status',
        'slug',

    ];
    
    protected $guarded = [
        'price',
        'quantity',
        'room_prefix',
        'booking_prefix',
        'adult',
        'child',
        'booking_from',
        'booking_till',
        'slug',
    ];

    protected $hidden = [
        'price',
        'quantity',
        'room_prefix',
        'booking_prefix',
        'adult',
        'child',
        'booking_from',
        'booking_till',
        'slug',
    ];
    
    public $timestamps = true;
}
