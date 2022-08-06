<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket_attachement extends Model
{
    use HasFactory;
    protected $fillable = [
        'ticket_msg_id',
        'attachments',      
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'ticket_msg_id',
        'attachments',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['ticket_msg_id'];

    public $timestamps = true;
}
