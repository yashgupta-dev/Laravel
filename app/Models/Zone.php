<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;
    protected $fillable = [
        'country_id',
        'name',
        'code',
        'status',
    ];
    
    protected $guarded = [
        
    ];
    protected $hidden = [
        
    ];
    
    public $timestamps = true;
}
