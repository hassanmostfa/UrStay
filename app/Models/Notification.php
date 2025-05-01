<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'msg',
        'is_seen',
        'is_send',
        'channel',
        'channel_type',
        'href',
    ];

    public function sends() {

        return $this->hasMany(Send::class);

    }
}
