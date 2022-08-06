<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;
    protected $fillable = [
        'domain',
        'img',
        
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    	'domain',
        'img',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    
    protected $casts = ['domain'];
}
