<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rooms_optionfacilitie extends Model
{
    use HasFactory;
    protected $fillable = [
        'room_id',
        'price_prefix',
        'price',
        'option_value_id',
        'status',
    ];
    
    protected $guarded = ['price_prefix',];

    protected $hidden = ['price_prefix',];
    
    public $timestamps = true;
}
