<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuestbookMessage extends Model
{
    protected $fillable = [
        'author',
        'message',
        'is_approved',
    ];

    protected function casts(): array
    {
        return [
            'is_approved' => 'boolean',
        ];
    }
}

