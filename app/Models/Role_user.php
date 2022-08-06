<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role_user extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_id',
        'user_id',
    ];
    
    protected $guarded = [
        'role_id',
        'user_id',
    ];
    protected $hidden = [
        'role_id',
        'user_id',
    ];

    protected $table = 'role_user';
    
    public $timestamps = true;

}
