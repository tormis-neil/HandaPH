<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoBagItem extends Model
{
    protected $fillable = [
        'category',
        'name',
        'description',
        'budget_alternative',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}