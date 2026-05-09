<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TyphoonMyth extends Model
{
    protected $fillable = [
        'myth',
        'fact',
        'action',
        'is_active',
    ];
}
