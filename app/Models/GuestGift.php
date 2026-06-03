<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuestGift extends Model
{
    protected $table = 'guest_gifts';
    
    protected $fillable = [
        'title',
        'image',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
