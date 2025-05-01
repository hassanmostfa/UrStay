<?php

namespace App\Http\Controllers\API\owner;

use App\Http\Controllers\Controller;
use App\Events\OwnerSupervisorMessageSent;
use Illuminate\Http\Request;
use App\Models\Supervisor;
use App\Models\OwnerSupervisorChatRoom;
use App\Models\OwnerSupervisorMessage;

class SupervisorChatController extends Controller
{
      // Get All Supervisors
      public function getSupervisors()
{
    try {
        $ownerId = auth()->user()->id;

        $supervisors = Supervisor::all();

        // Step 3: Add chat details for each owner
        $supervisorsWithChatDetails = $supervisors->map(function ($supervisor) use ($ownerId) {
            $chatRoom = OwnerSupervisorChatRoom::where('owner_id', $ownerId)
                ->where('supervisor_id', $supervisor->id)
                ->with(['owner_supervisor_messages' => function ($query) {
                    $query->orderBy('created_at', 'desc')->limit(1);
                }])
                ->first();

            // Calculate the unread message count
            $unreadCount = OwnerSupervisorMessage::where('chat_room_id', $chatRoom->id ?? null)
                ->where('is_read', false)
                ->where('sender_type', '!=', 'owner')
                ->count();

            $latestMessage = $chatRoom ? $chatRoom->owner_supervisor_messages->first() : null;

            return [
                'supervisor' => $supervisor,
                'latestMessage' => $latestMessage,
                'latestMessageTimestamp' => $latestMessage ? $latestMessage->created_at : null,
                'unreadCount' => $unreadCount,
            ];
        });

        // Sort supervisors by the newest message timestamp
        $sortedSupervisors = $supervisorsWithChatDetails->sortByDesc('latestMessageTimestamp')->values();

        return response()->json(['status' => 'success', 'data' => $sortedSupervisors], 200);
    } catch (\Exception $e) {
        return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
    }
}

          /***************************************************************************************/
           // Start a new chat or continue an existing one
      public function startOrResumeChat($supervisorId)
      {
          try{
              $ownerId = auth()->user()->id; // Assume the Owner is authenticated
  
              // Check if a chat session already exists between this seller and customer
              $chatRoom = OwnerSupervisorChatRoom::where('owner_id', $ownerId)
                  ->where('supervisor_id', $supervisorId)
                  ->first();
  
              // If no session exists, create a new one
              if (!$chatRoom) {
                  $chatRoom = OwnerSupervisorChatRoom::create([
                      'supervisor_id' => $supervisorId,
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
              $chatRoom = OwnerSupervisorChatRoom::findOrFail($chatRoomId);
      
              // Retrieve the messages in ascending order of creation
              $messages = $chatRoom->owner_supervisor_messages()->orderBy('created_at', 'asc')->get();
          
              // update is_read to true
              foreach ($messages as $message) {
                  if ($message->sender_type == 'supervisor') {
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
                  'message' => 'required|string',
              ]);
      
              // Identify the current user (either a seller or a customer)
              $sender = auth()->user();
      
              // Save the message
              $message = OwnerSupervisorMessage::create([
                  'chat_room_id' => $request->chat_room_id,
                  'sender_id' => $sender->id,
                  'sender_type' => 'owner',
                  'message' => $request->message,
                  'is_read' => false,
              ]);
      
              // Broadcast the new message using Laravel Echo
              event(new OwnerSupervisorMessageSent($message));
              
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
