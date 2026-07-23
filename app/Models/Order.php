<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'customer_name',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'zip',
        'products',
        'total',
        'notes',
        'status',
        'payment_method',
        'viewed',
    ];

    protected $casts = [
        'products' => 'array',
        'viewed' => 'boolean',
    ];
}

