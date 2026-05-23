<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
        'donor_name',
        'amount',
        'payment_method',
        'note',
        'confirmed',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'confirmed' => 'boolean',
        ];
    }
}

