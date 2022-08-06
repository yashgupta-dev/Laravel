<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Path extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'path_id',
        'level',
    ];
    
    protected $guarded = [
        'path_id',
        'level',
    ];
    protected $hidden = [
        'category_id',
        'path_id',
        'level',
    ];

    protected $table = 'category_path';
    
    public $timestamps = true;
}
