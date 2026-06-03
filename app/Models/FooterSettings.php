<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FooterSettings extends Model
{
    protected $fillable = [
        'company_name',
        'company_description',
        'quick_links',
        'customer_service_links',
        'social_links',
        'copyright_text',
    ];

    protected $casts = [
        'quick_links' => 'array',
        'customer_service_links' => 'array',
        'social_links' => 'array',
    ];
}

