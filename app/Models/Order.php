<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // protected $table = 'orders';
    protected $fillable = [
        'order_code',
        'order_mount',
        'order_change',
        'order_status',
    ];
}
