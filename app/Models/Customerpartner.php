<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customerpartner extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'hotel_id',
        'permission',
    ];
    
    protected $guarded = [
        'customer_id',
        'permission',
    ];
    protected $hidden = [
        'customer_id',
        'permission',
    ];
    
    public $timestamps = true;

    private function getOwnerName() {
        return $this->hasOne(User::class, 'id','customer_id');
    }
}
