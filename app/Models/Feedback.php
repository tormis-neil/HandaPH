<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedbacks';

    protected $fillable = [
        'effectiveness',
        'efficiency',
        'satisfaction_usefulness',
        'satisfaction_trust',
        'satisfaction_pleasure',
        'satisfaction_comfort',
        'risk_economic',
        'risk_health_safety',
        'risk_environmental',
        'context_coverage',
        'flexibility',
        'comments',
    ];
}