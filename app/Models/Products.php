<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $fillable = [
        'category_id',
        'product_photo',
        'product_name',
        'product_code',
        'product_price',
        'product_description',
        'is_active',
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id', 'id');
    }

    // public function getProductPhotoAttribute($value)
    // {
    //     return asset('storage/' . $value);
    // }
}
