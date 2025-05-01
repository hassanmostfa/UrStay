<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAdditionalInfo extends Model
{
    use HasFactory;

    protected $table = 'user_additional_info';

    protected $fillable = [
        'user_id',
        'location',
        'work',
        'preferred_languages',
        'preferred_places',
        'about',
        'interests',
    ];

    protected $casts = [
        'preferred_languages' => 'array',
        'preferred_places' => 'array',
        'interests' => 'array',
    ];
}
