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
        'why_choose_title',
        'why_choose_subtitle',
        'benefits_section_enabled',
    ];
}
