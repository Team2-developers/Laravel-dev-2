<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\User;
use App\Models\Img;

class NotificationController extends Controller
{
    public function getNotifications(Request $request)
    {
        $token = $request->bearerToken();
        $user = User::where('token', $token)->first();

        // retrieve notifications for the user
        $notifications = Notification::where('recipient_id', $user->user_id)
            ->with(['creator' => function ($query) {
                $query->select('user_id', 'user_name', 'img_id');
            }])->get();

        $result = [];
        $result['message'] = 'successfully';

        foreach ($notifications as $notification) {
            $creator = $notification->creator;
            $img_path = $creator->img ? $creator->img->img_path : null;

            $notificationArray = [
                'notification_id' => $notification->notification_id,
                'notification_message' => $notification->notification_message,
                'user_id' => $creator->user_id,
                'user_name' => $creator->user_name,
                'img_path' => $img_path,
            ];

            $result['notifications'][] = $notificationArray;
        }

        return response()->json($result);
    }
}
