<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $games = [
            [
                'game_status' => 'notstarted',
                'game_turn' => 'host',
                'life_id' => 1,
            ],
            [
                'game_status' => 'notstarted',
                'game_turn' => 'host',
                'life_id' => 2,
            ],
            [
                'game_status' => 'started',
                'game_turn' => 'user1',
                'life_id' => 3,
            ],
            [
                'game_status' => 'started',
                'game_turn' => 'user1',
                'life_id' => 4,
            ],
            [
                'game_status' => 'started',
                'game_turn' => 'user1',
                'life_id' => 1,
            ],
        ];

        foreach ($games as $game) {
            DB::table('games')->insert([
                'game_status' => $game['game_status'],
                'game_turn' => $game['game_turn'],
                'life_id' => $game['life_id'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
