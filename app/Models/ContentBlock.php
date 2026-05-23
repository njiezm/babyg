<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentBlock extends Model
{
    protected $fillable = [
        'group_name',
        'key',
        'label',
        'value',
        'sort_order',
    ];
}


