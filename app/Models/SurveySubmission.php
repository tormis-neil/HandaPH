<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SurveySubmission extends Model
{
    protected $fillable = [
        'location',
        'household_size',
        'special_needs',
        'house_type',
    ];

    protected $casts = [
        'special_needs' => 'array',
    ];
}