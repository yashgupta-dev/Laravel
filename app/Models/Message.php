<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $fillable = [
        'inbox_id',
        'sender',
        'receiver',
        'msg',      
        'msg_type',
        'admin_read_status',
        'user_read_status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'inbox_id',
        'sender',
        'receiver',
        'msg',      
    ];

    protected $table = 'messages';
}
