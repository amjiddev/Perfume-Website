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
        'about_heading',
        'about_description',
        'about_image',
        'about_features',
    ];

    protected $casts = [
        'about_features' => 'array',
    ];
}

