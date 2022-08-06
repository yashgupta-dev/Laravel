<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
class Ticket extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'subject',
        'message',
        'status',     
        'priority',   
        'admin_read_status',
        'user_read_status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        // 'user_id',
        // 'subject',
        'message',
        // 'status',
        // 'priority',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['user_id', 'status','message'];

    protected function ticket_msg() {
        return $this->hasMany( Ticket_message::class, 'ticket_id', 'id');        
    }
    protected function last_reply() {
        return $this->hasOne( Ticket_message::class, 'ticket_id', 'id')->select('created_at')->orderBy('created_at','desc')->where('user_id','0');        
    }
    protected function user(){
        return $this->hasOne( User::class, 'id', 'user_id');
    }

    protected function assigneusers(){
        return $this->hasMany( Ticketassign::class, 'ticket_id', 'id');
    }

    protected function assign(){
        return $this->hasOne( Ticketassign::class, 'ticket_id','id');
    }

    protected function replies(){
        return $this->hasMany( Ticket_message::class, 'ticket_id', 'id')->where('from','!=','0');
    }
    protected function getStatus() {
        return $this->hasOne(Statusmange::class,'id','status');
    }
    
    protected function supportreplies(){
        return $this->hasMany( Ticket_message::class, 'ticket_id', 'id')->where('from','0');
    }
    
}
