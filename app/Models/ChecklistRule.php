<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChecklistRule extends Model
{
    protected $fillable = [
        'item_text',
        'phase',
        'tag',
        'tag_class',
        'locations',
        'sizes',
        'special_needs',
        'house_types',
        'is_active',
    ];

    protected $casts = [
        'locations' => 'array',
        'sizes' => 'array',
        'special_needs' => 'array',
        'house_types' => 'array',
        'is_active' => 'boolean',
    ];
}