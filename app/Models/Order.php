<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // protected $table = 'orders';
    protected $fillable = [
        'order_code',
        'order_date',
        'order_mount',
        'order_change',
        'order_status',
    ];

    public function category()
    {
        return $this->hasMany(Categories::class, 'id', 'category_id');
    }

    public function orderDetails()
    {
        return $this->hasMany(orderDetails::class, 'order_id', 'id');
    }

    public function product()
    {
        return $this->hasMany(Products::class, 'id', 'product_id');
    }
}
