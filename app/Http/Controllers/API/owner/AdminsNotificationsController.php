<?php

namespace App\Http\Controllers\API\owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\AdminOwnerNotification;

class AdminsNotificationsController extends Controller
{
    // get all notifications
    public function index(){
        try{
            $notifications = AdminOwnerNotification::where('owner_id', Auth::user()->id)
            ->where('sender_type', 'admin')->get();
            return response()->json([
                'status' => 'success',
                'data' => $notifications,
            ]);
        }catch(\Exception $e){
            return response()->json([
                'status' => 'error',
                'msg' => $e->getMessage(),
            ]);
        }
    }

    /*********************************************************************************/
    // Send Notification
    public function store(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'content' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => false, 'msg' => $validator->errors()->first(), 'data' => null], 422);
            }

            $notification = new AdminOwnerNotification();
            $notification->owner_id = Auth::user()->id;
            $notification->sender_type = 'owner';
            $notification->content = $request->content;
            $notification->save();

            return response()->json([
                'status' => 'success',
                'data' => $notification,
            ]);
        }catch(\Exception $e){
            return response()->json([
                'status' => 'error',
                'msg' => $e->getMessage(),
            ]);
        }
    }
    /**********************************************************************************/
    // Mark All Notifications As Read
    public function markAllAsRead(){
        try{
            AdminOwnerNotification::where('owner_id', Auth::user()->id)
            ->where('sender_type', 'admin')->update(['is_read' => true]);
            
            return response()->json([
                'status' => 'success',
                'data' => 'All notifications marked as read successfully'
            ]);
        }catch(\Exception $e){
            return response()->json([
                'status' => 'error',
                'msg' => $e->getMessage(),
            ]);
        }
    }
}
