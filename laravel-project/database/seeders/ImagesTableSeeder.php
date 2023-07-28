<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $imgPaths = [
            'https://mp-class.chips.jp/lifegame/cat_user1.jpg',
            'https://mp-class.chips.jp/lifegame/cat_user2.jpg',
            'https://mp-class.chips.jp/lifegame/cat_user3.jpg',
            'https://mp-class.chips.jp/lifegame/cat_user4.jpg',
        ];

        foreach ($imgPaths as $imgPath) {
            DB::table('imgs')->insert([
                'img_path' => $imgPath,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
