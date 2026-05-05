<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedbacks';

    protected $fillable = [
        'rating',
        'easy_to_understand',
        'helpful_prepare',
        'improve_comments',
        'region',
    ];
}