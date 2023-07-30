<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Notification;

class NotificationSeeder extends Seeder
{
    public function run()
    {
        $notifications = [
            [
                'notification_message' => 'First notification message',
                'notification_user' => 1,
            ],
            [
                'notification_message' => 'Second notification message',
                'notification_user' => 2,
            ],
            [
                'notification_message' => 'Third notification message',
                'notification_user' => 3,
            ],
            [
                'notification_message' => 'Fourth notification message',
                'notification_user' => 4,
            ]
        ];

        foreach ($notifications as $data) {
            Notification::create($data);
        }
    }
}
