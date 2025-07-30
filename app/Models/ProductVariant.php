<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
     protected $fillable = [
        'product_id',
        'weight',
        'size',
        'price',
        'oldprice',
        'stock',
        'cost',
        'discount',
        'length',
        'width',
        'height',
        'net_weight'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'variant_id');
    }
}