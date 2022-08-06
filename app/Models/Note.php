<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'ticket_msg_id',
        'notes_added_name',
        'notes',      
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'ticket_msg_id',
        'notes_added_name',
        'notes',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['ticket_msg_id'];

    public $timestamps = true;

    protected function agent(){
        return $this->hasOne( Admin::class, 'id', 'user_id');
    }
}
