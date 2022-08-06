<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin_role extends Model
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

    protected $table = 'admin_role';
    
    public $timestamps = true;
}
