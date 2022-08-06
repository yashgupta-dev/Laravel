<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inboxe extends Model
{
    use HasFactory;
    protected $fillable = [
        'sender',
        'receiver', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'sender',
        'receiver',  
    ];
}
