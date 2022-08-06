<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rooms_fixedfacilitie extends Model
{
    use HasFactory;
    protected $fillable = [
        'room_id',
        'name',
        'facility_id',
        'description',
    ];
    
    protected $guarded = [];

    protected $hidden = [];
    
    public $timestamps = true;
}
