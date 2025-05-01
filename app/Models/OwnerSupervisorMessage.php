<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OwnerSupervisorMessage extends Model
{
    use HasFactory;

    protected $table = 'owner_supervisor_messages';

    protected $fillable = [
        'chat_room_id',
        'sender_id',
        'sender_type',
        'message',
        'is_read',
    ];

    public function owner_supervisor_chat_rooms(){
        return $this->belongsTo(OwnerSupervisorChatRoom::class, 'chat_room_id');
    }

}
