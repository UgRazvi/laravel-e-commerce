<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    use HasFactory;

    protected $guard = ["id"];
    protected $fillable = [
        'user_id',
        'name',
        'mobile_no',
        'address',
        'locality_town',
        'city',
        'state',
        'pincode',
        'type',
        'default_address',
    ];
}