<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GameEventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $eventTitles = [
            'Event Title 1',
            'Event Title 2',
            'Event Title 3',
            'Event Title 4',
            'Event Title 5',
            'Event Title 6',
            'Event Title 7',
            'Event Title 8',
            'Event Title 9',
            'Event Title 10',
        ];

        $eventDetails = [
            'Event Detail 1',
            'Event Detail 2',
            'Event Detail 3',
            'Event Detail 4',
            'Event Detail 5',
            'Event Detail 6',
            'Event Detail 7',
            'Event Detail 8',
            'Event Detail 9',
            'Event Detail 10',
        ];

        foreach ($eventTitles as $index => $title) {
            DB::table('game_events')->insert([
                'event_title' => $title,
                'event_detail' => $eventDetails[$index],
                'event_point' => rand(0, 50), // ポイントはランダムな値に設定します
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
