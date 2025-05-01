<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Send;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    public function create(Request $data) {

        $msg = $data->msg;
        $channel = $data->channel;
        $channel_type = $data->channel_type;
        $href = $data->href;

        try {
            $notification = Notification::create([
                'msg' => $msg,
                'channel' => $channel,
                'channel_type' => $channel_type,
                'href' => $href,
            ]);

            if ($notification) {
                return response()->json([
                    'status' => true,
                    'message' => 'Notification created successfully',
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage() ?? 'Error creating notification',
            ]);
        }
    }

    public function adminSSE($admin_id) {
        $notification = Notification::
        whereDoesntHave('sends', function ($query) use ($admin_id) {
            $query->where('admin_id', $admin_id);
        })
        ->first();

        header('Content-Type: text/event-stream');
        header('Cache-Control: no-cache');
        header('Connection: keep-alive');

        if ($notification) {
            $eventData = [
                'message' => $notification->msg,
                'href' => $notification->href,
            ];

            echo "data:" . json_encode($eventData) . "\n\n";
            Send::create([
                'admin_id' => $admin_id,
                'notification_id' => $notification->id,
            ]);
        } else {
            echo '\n\n';
        }

        ob_flush();
        flush();
    }

    public function getAdminNotifications() {
        $perPage = 10; // Number of notifications per page
        $notifications = Notification::latest()->where('channel', "Admin")->paginate($perPage);

        return response()->json($notifications);
    }
}
