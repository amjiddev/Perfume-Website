<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerfumePage extends Model
{
    protected $table = 'perfume_pages';

    protected $fillable = [
        'hero_heading',
        'hero_subheading',
        'hero_image',
        'best_sellers_title',
        'best_sellers_subtitle',
        'testimonials_title',
        'testimonials_subtitle',
    ];
}
