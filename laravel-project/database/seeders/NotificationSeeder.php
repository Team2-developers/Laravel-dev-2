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
                'creator_id' => 0,
                'recipient_id' => 1,
            ],
            [
                'notification_message' => 'Second notification message',
                'creator_id' => 0,
                'recipient_id' => 2,
            ],
            [
                'notification_message' => 'Third notification message',
                'creator_id' => 0,
                'recipient_id' => 3,
            ],
            [
                'notification_message' => 'Fourth notification message',
                'creator_id' => 0,
                'recipient_id' => 4,
            ]
        ];

        foreach ($notifications as $data) {
            Notification::create($data);
        }
    }
}
