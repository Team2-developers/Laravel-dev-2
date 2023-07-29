<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Life;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class LifeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        DB::table('lifes')->insert([
            [
                'img_id' => 5,
                'life_name' => 'User1 Life',
                'life_detail' => 'Life Detail',
                'life_message' => 'Message',
                'user_id' => 1,
                'good' => 10,
                'release' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ], [
                'img_id' => 6,
                'life_name' => 'User2 Life',
                'life_detail' => 'Life Detail',
                'life_message' => 'Message',
                'user_id' => 2,
                'good' => 10,
                'release' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ], [
                'img_id' => 7,
                'life_name' => 'User3 Life',
                'life_detail' => 'Life Detail',
                'life_message' => 'Message',
                'user_id' => 3,
                'good' => 10,
                'release' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ], [
                'img_id' => 8,
                'life_name' => 'User4 Life',
                'life_detail' => 'Life Detail',
                'life_message' => 'Message',
                'user_id' => 4,
                'good' => 10,
                'release' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
