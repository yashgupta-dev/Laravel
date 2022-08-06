<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'iso_code_2',
        'iso_code_3',
        'address_format',
        'postcode_required',
        'status',
    ];
    
    protected $guarded = [
        
    ];
    protected $hidden = [
        
    ];

    protected $table = 'country';
    
    public $timestamps = true;
}
