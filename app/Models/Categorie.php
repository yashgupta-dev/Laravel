<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'parent_id',
        'status',
    ];
    
    protected $guarded = [
        'parent_id',
    ];
    protected $hidden = [
        'name',
        'parent_id',
    ];

    protected $table = 'categories';
    
    public $timestamps = true;
}
