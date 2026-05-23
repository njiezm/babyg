<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimelineEvent extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'image_url',
        'event_date',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'event_date' => 'date',
        ];
    }
}

