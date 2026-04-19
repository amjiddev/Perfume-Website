<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutPage extends Model
{
    protected $fillable = [
        'title',
        'description',
        'hero_image',
        'hero_heading',
        'hero_subheading',
        'content_section_1_title',
        'content_section_1_description',
        'content_section_1_image',
        'content_section_2_title',
        'content_section_2_description',
        'content_section_2_image',
        'mission_title',
        'mission_description',
        'vision_title',
        'vision_description',
        'values_title',
        'values_description',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
