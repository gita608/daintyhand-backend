<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomOrder extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'product_type',
        'quantity',
        'budget',
        'event_date',
        'description',
        'additional_notes',
        'status',
    ];

    protected $casts = [
        'event_date' => 'date',
    ];
}
