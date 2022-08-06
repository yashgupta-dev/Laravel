<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Optionalfaclitie extends Model
{
    use HasFactory;

    protected $fillable = [
        'optional_facilitie_name',
        'optional_facilitie_icon',
        'optional_facilitie_sort',
    ];
    
    protected $guarded = [];
    protected $hidden = [];
    
    public $timestamps = true;
}
