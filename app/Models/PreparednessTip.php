<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PreparednessTip extends Model
{
    protected $fillable = [
        'logic_id',
        'title',
        'content',
        'tag',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
