<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    protected $fillable = [
        'account_branch',
        'bank_name',
        'account_name',
        'user_id',
        'account_no',
        'account_ifsc',
        'default'
    ];
    
    protected $guarded = [
        'account_no',
        'user_id',
        'account_ifsc',
        'default'
    ];
    protected $hidden = [
        'bank_name',
        'user_id',
        'account_no',
        'account_ifsc',
        'default'
    ];

    public $timestamps = true;
}
