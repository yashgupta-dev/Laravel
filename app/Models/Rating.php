<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'hotel_id',
        'rating',
        'description',
        'status',
    ];
    
    protected $guarded = [
        'customer_id',
        'hotel_id',
        'rating',
        'description',
        'status',
    ];
    protected $hidden = [
        'customer_id',
        'hotel_id',
        'rating',
        'description',
        'status',
    ];
    
    public $timestamps = true;
}

