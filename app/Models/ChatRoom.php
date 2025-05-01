<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatRoom extends Model
{
    use HasFactory;

    protected $table = 'chat_rooms';

    protected $fillable = [
        'user_id',
        'owner_id',
    ];

    public function messages(){
        return $this->hasMany(Message::class);
    }

    public function owner(){
        return $this->belongsTo(Owner::class , "owner_id");
    }

    public function user(){
        return $this->belongsTo(User::class , "user_id");
    }

     // Check if the seller can access the chat room
 public function canAccessChatRoomAsOwner(Owner $owner)
 {
     return $this->owner_id === $owner->id;
 }

 // Check if the customer can access the chat room
 public function canAccessChatRoomAsUser(User $user)
 {
     return $this->user_id === $user->id;
 }

}
