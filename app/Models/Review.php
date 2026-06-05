<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'author',
        'email',
        'rating',
        'text',
        'display_section',
        'image',
        'status',
    ];

    protected $casts = [
        'rating' => 'decimal:1',
    ];
}

