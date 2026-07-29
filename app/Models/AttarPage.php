<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttarPage extends Model
{
    protected $table = 'attar_pages';

    protected $fillable = [
        'hero_heading',
        'hero_subheading',
        'hero_image',
        'hero_image_1',
        'hero_image_2',
        'hero_image_3',
        'hero_image_4',
        'why_choose_title',
        'why_choose_subtitle',
        'benefits_section_enabled',
    ];
}
