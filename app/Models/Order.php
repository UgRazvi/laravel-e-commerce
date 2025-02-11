<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function product_images()
    {
        return $this->hasMany(ProductImages::class);
    }
    protected $fillable = ['*'];
    // protected $fillable = ['order_status', 'payment_status', /* other fields */];

}
