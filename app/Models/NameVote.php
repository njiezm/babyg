<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NameVote extends Model
{
    protected $fillable = [
        'name_option_id',
        'voter_name',
        'ip_address',
    ];

    public function option(): BelongsTo
    {
        return $this->belongsTo(NameOption::class, 'name_option_id');
    }
}

