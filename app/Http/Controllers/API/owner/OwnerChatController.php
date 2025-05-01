<?php

namespace App\Http\Controllers\API\owner;

use App\Events\NewMessage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\ChatRoom;
use App\Models\Message;
use App\Models\Booking;
use App\Models\Owner;
use App\Models\User;

class OwnerChatController extends Controller
{
    // Get All Users that treat with this owner from bookings table
    public function getUsers()
    {
        try {
            $ownerId = auth()->user()->id;
    

            // Step 2: get all users
            $users = User::all();
    
            // Step 3: Add chat details for each owner
            $usersWithChatDetails = $users->map(function ($user) use ($ownerId) {
                $chatRoom = ChatRoom::where('owner_id', $ownerId)
                    ->where('user_id', $user->id)
                    ->with(['messages' => function ($query) {
                        $query->orderBy('created_at', 'desc')->limit(1);
                    }])
                    ->first();
    
                
                // Calculate the unread message count
                $unreadCount = Message::where('chat_room_id', $chatRoom->id ?? null)
                    ->where('is_read', false)
                    ->where('sender_type', '!=', 'owner')
                    ->count();
                    
    
                $latestMessage = $chatRoom ? $chatRoom->messages->first() : null;
    
                return [
                    'user' => $user,
                    'latestMessage' => $latestMessage,
                    'unreadCount' => $unreadCount,
                ];
            });
    
            return response()->json(['status' => 'success', 'data' => $usersWithChatDetails], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
        /***************************************************************************************/
         // Start a new chat or continue an existing one
    public function startOrResumeChat($userId)
    {
        try{
            $ownerId = auth()->user()->id; // Assume the Owner is authenticated

            // Check if a chat session already exists between this seller and customer
            $chatRoom = ChatRoom::where('owner_id', $ownerId)
                ->where('user_id', $userId)
                ->first();

            // If no session exists, create a new one
            if (!$chatRoom) {
                $chatRoom = ChatRoom::create([
                    'user_id' => $userId,
                    'owner_id' => $ownerId,
                ]);
            }
            // Redirect to the messages view with the chat session
            return response()->json(['status' => 'success','data' =>$chatRoom], 200);
        }catch(\Exception $e){
            return response()->json(['status' => 'error','message' => $e->getMessage()], 500);
        }
    }
    
    /**************************************************************************************/
    // Display the messages view for an existing chat session
    public function showMessages($chatRoomId)
    {
        try{
            $chatRoom = ChatRoom::findOrFail($chatRoomId);
    
            // Retrieve the messages in ascending order of creation
            $messages = $chatRoom->messages()->orderBy('created_at', 'asc')->get();
        
            // update is_read to true
            foreach ($messages as $message) {
                if ($message->sender_type == 'user') {
                    $message->update(['is_read' => true]);
                }
            }
        
            return response()->json(['status' => 'success','data' => $messages]);
        }catch(\Exception $e){
            return response()->json(['status' => 'error','message' => $e->getMessage()], 500);
        }
    }
    
    /***************************************************************************************/
    // Store a new message in the chat session
    public function sendMessage(Request $request)
    {
        try{
            $request->validate([
                'chat_room_id' => 'required|exists:chat_rooms,id',
                'content' => 'required|string',
            ]);
    
            // Identify the current user (either a seller or a customer)
            $sender = auth()->user();
    
            // Save the message
            $message = Message::create([
                'chat_room_id' => $request->chat_room_id,
                'sender_id' => $sender->id,
                'sender_type' => 'owner',
                'content' => $request->content,
                'is_read' => false,
            ]);
    
            // Broadcast the new message using Laravel Echo
            event(new NewMessage($message));
            
                // Return a JSON response for confirmation
                return response()->json([
                    'status' => 'success',
                    'message' => 'Message sent successfully',
                    'data' => $message,
                ]);
        }catch(\Exception $e){
            return response()->json(['status' => 'error','message' => $e->getMessage()], 500);
        }
    }
}
