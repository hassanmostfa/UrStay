<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Auth;
use App\Models\ChatRoom;
use App\Models\Owner;
use App\Models\User;
use App\Models\Negotiation;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('chat-room.{chatRoomId}', function ($user, $chatRoomId) {
    // Find the chat room by ID
    $chatRoom = ChatRoom::find($chatRoomId);
    
    // Check if the chat room exists
    if ($chatRoom) {
        // Check if the user is a seller or customer and authorize based on that
        if ($user instanceof \App\Models\Owner) {
            return $chatRoom->canAccessChatRoomAsOwner($user);
        } elseif ($user instanceof \App\Models\User) {
            return $chatRoom->canAccessChatRoomAsUser($user);
        }
    }

    return false; // Unauthorized access if the chat room does not exist or user can't access
});



Broadcast::channel('owner-supervisor-chat.{chatRoomId}', function ($user, $chatRoomId) {
    // Find the chat room by ID
    $chatRoom = \App\Models\OwnerSupervisorChatRoom::find($chatRoomId);

    // Check if the chat room exists
    if ($chatRoom) {
        // Verify the user is either the owner or the supervisor in the chat room
        if ($user instanceof \App\Models\Owner && $chatRoom->owner_id === $user->id) {
            return true; // Owner is authorized
        } elseif ($user instanceof \App\Models\Supervisor && $chatRoom->supervisor_id === $user->id) {
            return true; // Supervisor is authorized
        }
    }

    return false; // Deny access if the chat room doesn't exist or the user isn't authorized
});


