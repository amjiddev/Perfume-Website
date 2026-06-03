<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactPage extends Model
{
    protected $fillable = [
        'title',
        'hero_heading',
        'hero_subheading',
        'hero_image',
        'description',
        'phone',
        'email',
        'address',
        'office_hours',
        'map_embed_code',
        'contact_form_title',
        'contact_form_description',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
