<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserOwnerNotification extends Model
{
    use HasFactory;

    protected $table = 'user_owner_notifications';

    protected $fillable = [
        'user_id',
        'owner_id',
        'sender_type',
        'content',
        'is_read',
    ];

    public function user(){
        return $this->belongsTo(User::class , "user_id");
    }

    public function owner(){
        return $this->belongsTo(Owner::class , "owner_id");
    }
}
