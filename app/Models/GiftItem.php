<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GiftItem extends Model
{
    protected $fillable = [
        'name',
        'category',
        'price',
        'image_url',
        'is_reserved',
        'reserved_by',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_reserved' => 'boolean',
            'price' => 'decimal:2',
        ];
    }
}

