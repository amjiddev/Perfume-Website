<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomePage extends Model
{
    protected $fillable = [
        'hero_heading',
        'hero_subheading',
        'hero_image_1',
        'hero_image_2',
        'hero_image_1_mobile',
        'hero_image_1_tablet',
        'hero_image_1_laptop',
        'hero_image_2_mobile',
        'hero_image_2_tablet',
        'hero_image_2_laptop',
        'about_heading',
        'about_description',
        'about_image',
        'about_features',
    ];

    protected $casts = [
        'about_features' => 'array',
    ];
}

