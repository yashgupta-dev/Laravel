<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotelpermission extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'menu_permission',
    ];
    
    protected $guarded = [
        'menu_permission',
    ];
    protected $hidden = [
        'menu_permission',
    ];
    
    public $timestamps = true;
}
