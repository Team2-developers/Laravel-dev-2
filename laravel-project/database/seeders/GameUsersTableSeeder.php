<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GameUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gameUserEntries = [
            ['game_id' => 2, 'user_id' => 1, 'score' => 0, 'current_cell' => 0],
            ['game_id' => 2, 'user_id' => 2, 'score' => 0, 'current_cell' => 0],
            ['game_id' => 2, 'user_id' => 3, 'score' => 0, 'current_cell' => 0],
            ['game_id' => 2, 'user_id' => 4, 'score' => 0, 'current_cell' => 0],
            ['game_id' => 3, 'user_id' => 1, 'score' => 10, 'current_cell' => 0],
            ['game_id' => 3, 'user_id' => 2, 'score' => 10, 'current_cell' => 0],
            ['game_id' => 3, 'user_id' => 3, 'score' => 10, 'current_cell' => 0],
            ['game_id' => 3, 'user_id' => 4, 'score' => 10, 'current_cell' => 0],
            ['game_id' => 4, 'user_id' => 1, 'score' => 10, 'current_cell' => 10],
            ['game_id' => 4, 'user_id' => 2, 'score' => 10, 'current_cell' => 10],
            ['game_id' => 4, 'user_id' => 3, 'score' => 10, 'current_cell' => 10],
            ['game_id' => 4, 'user_id' => 4, 'score' => 10, 'current_cell' => 10],
            ['game_id' => 5, 'user_id' => 1, 'score' => 10, 'current_cell' => 20],
            ['game_id' => 5, 'user_id' => 2, 'score' => 10, 'current_cell' => 20],
            ['game_id' => 5, 'user_id' => 3, 'score' => 10, 'current_cell' => 20],
            ['game_id' => 5, 'user_id' => 4, 'score' => 10, 'current_cell' => 20],
        ];

        foreach ($gameUserEntries as $entry) {
            DB::table('game_users')->insert([
                'game_id' => $entry['game_id'],
                'user_id' => $entry['user_id'],
                'score' => $entry['score'],
                'current_cell' => $entry['current_cell'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
