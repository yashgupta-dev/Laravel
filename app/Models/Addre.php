<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addre extends Model
{
    use HasFactory;
    protected $fillable = [
        'address_1',
        'address_2',
        'land_mark',
        'user_id',
        'country',
        'state',
        'city',
        'postal',
    ];
    
    protected $guarded = [
        'postal',
        'user_id',
        'address_1',
    ];
    protected $hidden = [
        'postal',
        'user_id',
        'address_1',
    ];
    public $timestamps = true;
}
