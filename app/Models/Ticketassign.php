<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticketassign extends Model
{
    use HasFactory;
    protected $fillable = [
        'ticket_id',
        'user_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'ticket_id',
        'user_id',  
    ];

    protected function agent(){
        return $this->hasOne( Admin::class, 'id', 'user_id');
    }

}
