<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OwnerSupervisorChatRoom extends Model
{
    use HasFactory;

    protected $table = 'owner_supervisor_chat_rooms';

    protected $fillable = [
        'owner_id',
        'supervisor_id',
    ];


    
    public function owner_supervisor_messages(){
        return $this->hasMany(OwnerSupervisorMessage::class , 'chat_room_id');
    }

    public function owner(){
        return $this->belongsTo(Owner::class , "owner_id");
    }

    public function supervisor(){
        return $this->belongsTo(Supervisor::class , "supervisor_id");
    }

     // Check if the seller can access the chat room
 public function canAccessChatRoomAsOwner(Owner $owner)
 {
     return $this->owner_id === $owner->id;
 }

 // Check if the customer can access the chat room
 public function canAccessChatRoomAsSupervisor(Supervisor $supervisor)
 {
     return $this->supervisor_id === $supervisor->id;
 }


}
