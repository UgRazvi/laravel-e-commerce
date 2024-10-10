<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountCoupon extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'name',
        'description',
        'max_usage',
        'max_usage_user',
        'type',
        'discount_amount',
        'min_amount',
        'starts_at',
        'expires_at',
        'status'
    ];

}
