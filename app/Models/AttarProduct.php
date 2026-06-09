<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttarProduct extends Model
{
    protected $table = 'attar_products';

    protected $fillable = [
        'name',
        'description',
        'type',
        'price',
        'original_price',
        'rating',
        'reviews_count',
        'image',
        'discount_percentage',
        'sort_order',
    ];

    protected $casts = [
        'price' => 'float',
        'original_price' => 'float',
        'rating' => 'float',
        'reviews_count' => 'integer',
        'discount_percentage' => 'integer',
        'sort_order' => 'integer',
    ];
}
