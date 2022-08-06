<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fixedfacilitie extends Model
{
    use HasFactory;
    protected $fillable = [
        'faciltie_name',
        'faciltie_icon',
        'faciltie_status',
    ];
    
    protected $guarded = [];

    protected $hidden = [];
    
    public $timestamps = true;
}
