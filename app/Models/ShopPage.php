<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopPage extends Model
{
    protected $fillable = [
        'title',
        'description',
        'hero_image',
        'hero_heading',
        'hero_subheading',
        'featured_products',
        'show_home_page',
        'show_about_page',
        'show_shop_by_category',
    ];

    protected $casts = [
        'show_home_page' => 'boolean',
        'show_about_page' => 'boolean',
        'show_shop_by_category' => 'boolean',
        'featured_products' => 'array',
    ];
}
