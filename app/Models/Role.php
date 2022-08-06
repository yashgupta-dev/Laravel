<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'permission',
    ];
    
    protected $guarded = [
        'permission',
    ];
    protected $hidden = [
        'permission',
    ];
    
    public $timestamps = true;
}
