<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket_message extends Model
{
    use HasFactory;
    protected $fillable = [
        'ticket_id',
        'user_id',
        'r_msg',
        'from',
        'to',        
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'ticket_id',
        'user_id',
        'r_msg',
        'from',
        'to',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['ticket_id', 'from','to'];
    
    protected function msg_attachement(){
        return $this->hasMany( Ticket_attachement::class, 'ticket_msg_id', 'id');
    }

    protected function notes(){
        return $this->hasMany( Note::class, 'ticket_msg_id', 'id');
    }

    protected function agent(){
        return $this->hasOne( Admin::class, 'id', 'user_id');
    }
}
