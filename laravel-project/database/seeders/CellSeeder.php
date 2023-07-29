<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CellSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        $data = [
            [
                "cell_detail" => "First Cell",
                "cell_no" => 1,
                "cell_point" => 10,
                "cell_color" => "#FF0000",
                "life_id" => 1
            ],
            [
                "cell_detail" => "Second Cell",
                "cell_no" => 2,
                "cell_point" => 5,
                "cell_color" => "#0000FF",
                "life_id" => 1
            ],
            [
                "cell_detail" => "Third Cell",
                "cell_no" => 3,
                "cell_point" => 0,
                "cell_color" => "#00FF00",
                "life_id" => 1
            ],
            [
                "cell_detail" => "Fourth Cell",
                "cell_no" => 4,
                "cell_point" => 5,
                "cell_color" => "#FFFF00",
                "life_id" => 1
            ],
            [
                "cell_detail" => "Fifth Cell",
                "cell_no" => 5,
                "cell_point" => 3,
                "cell_color" => "#FFA500",
                "life_id" => 1
            ],
            [
                "cell_detail" => "Sixth Cell",
                "cell_no" => 6,
                "cell_point" => 5,
                "cell_color" => "#FFC0CB",
                "life_id" => 1
            ],
            [
                "cell_detail" => "Seventh Cell",
                "cell_no" => 7,
                "cell_point" => 4,
                "cell_color" => "#800080",
                "life_id" => 1
            ],
            [
                "cell_detail" => "Eighth Cell",
                "cell_no" => 8,
                "cell_point" => 5,
                "cell_color" => "#A52A2A",
                "life_id" => 1
            ],
            [
                "cell_detail" => "Ninth Cell",
                "cell_no" => 9,
                "cell_point" => 3,
                "cell_color" => "#00FF00",
                "life_id" => 1
            ],
            [
                "cell_detail" => "Tenth Cell",
                "cell_no" => 10,
                "cell_point" => 7,
                "cell_color" => "#FF00FF",
                "life_id" => 1
            ],
            [
                "cell_detail" => "Eleventh Cell",
                "cell_no" => 11,
                "cell_point" => 8,
                "cell_color" => "#00FFFF",
                "life_id" => 1
            ],
            [
                "cell_detail" => "Twelfth Cell",
                "cell_no" => 12,
                "cell_point" => 6,
                "cell_color" => "#4B0082",
                "life_id" => 1
            ],
            [
                "cell_detail" => "Thirteenth Cell",
                "cell_no" => 13,
                "cell_point" => 9,
                "cell_color" => "#000000",
                "life_id" => 1
            ],
            [
                "cell_detail" => "Fourteenth Cell",
                "cell_no" => 14,
                "cell_point" => 2,
                "cell_color" => "#FFFFFF",
                "life_id" => 1
            ],
            [
                "cell_detail" => "Fifteenth Cell",
                "cell_no" => 15,
                "cell_point" => 1,
                "cell_color" => "#F5F5DC",
                "life_id" => 1
            ],
            [
                "cell_detail" => "Sixteenth Cell",
                "cell_no" => 16,
                "cell_point" => 7,
                "cell_color" => "#008080",
                "life_id" => 1
            ],
            [
                "cell_detail" => "Seventeenth Cell",
                "cell_no" => 17,
                "cell_point" => 10,
                "cell_color" => "#800000",
                "life_id" => 1
            ],
            [
                "cell_detail" => "Eighteenth Cell",
                "cell_no" => 18,
                "cell_point" => 6,
                "cell_color" => "#808000",
                "life_id" => 1
            ],
            [
                "cell_detail" => "Nineteenth Cell",
                "cell_no" => 19,
                "cell_point" => 9,
                "cell_color" => "#FF7F50",
                "life_id" => 1
            ],
            [
                "cell_detail" => "Twentieth Cell",
                "cell_no" => 20,
                "cell_point" => 10,
                "cell_color" => "#808080",
                "life_id" => 1
            ],
            [
                "cell_detail" => "First Cell",
                "cell_no" => 1,
                "cell_point" => 10,
                "cell_color" => "#FF0000",
                "life_id" => 2
            ],
            [
                "cell_detail" => "Second Cell",
                "cell_no" => 2,
                "cell_point" => 5,
                "cell_color" => "#0000FF",
                "life_id" => 2
            ],
            [
                "cell_detail" => "Third Cell",
                "cell_no" => 3,
                "cell_point" => 0,
                "cell_color" => "#00FF00",
                "life_id" => 2
            ],
            [
                "cell_detail" => "Fourth Cell",
                "cell_no" => 4,
                "cell_point" => 5,
                "cell_color" => "#FFFF00",
                "life_id" => 2
            ],
            [
                "cell_detail" => "Fifth Cell",
                "cell_no" => 5,
                "cell_point" => 3,
                "cell_color" => "#FFA500",
                "life_id" => 2
            ],
            [
                "cell_detail" => "Sixth Cell",
                "cell_no" => 6,
                "cell_point" => 5,
                "cell_color" => "#FFC0CB",
                "life_id" => 2
            ],
            [
                "cell_detail" => "Seventh Cell",
                "cell_no" => 7,
                "cell_point" => 4,
                "cell_color" => "#800080",
                "life_id" => 2
            ],
            [
                "cell_detail" => "Eighth Cell",
                "cell_no" => 8,
                "cell_point" => 5,
                "cell_color" => "#A52A2A",
                "life_id" => 2
            ],
            [
                "cell_detail" => "Ninth Cell",
                "cell_no" => 9,
                "cell_point" => 3,
                "cell_color" => "#00FF00",
                "life_id" => 2
            ],
            [
                "cell_detail" => "Tenth Cell",
                "cell_no" => 10,
                "cell_point" => 7,
                "cell_color" => "#FF00FF",
                "life_id" => 2
            ],
            [
                "cell_detail" => "Eleventh Cell",
                "cell_no" => 11,
                "cell_point" => 8,
                "cell_color" => "#00FFFF",
                "life_id" => 2
            ],
            [
                "cell_detail" => "Twelfth Cell",
                "cell_no" => 12,
                "cell_point" => 6,
                "cell_color" => "#4B0082",
                "life_id" => 2
            ],
            [
                "cell_detail" => "Thirteenth Cell",
                "cell_no" => 13,
                "cell_point" => 9,
                "cell_color" => "#000000",
                "life_id" => 2
            ],
            [
                "cell_detail" => "Fourteenth Cell",
                "cell_no" => 14,
                "cell_point" => 2,
                "cell_color" => "#FFFFFF",
                "life_id" => 2
            ],
            [
                "cell_detail" => "Fifteenth Cell",
                "cell_no" => 15,
                "cell_point" => 1,
                "cell_color" => "#F5F5DC",
                "life_id" => 2
            ],
            [
                "cell_detail" => "Sixteenth Cell",
                "cell_no" => 16,
                "cell_point" => 7,
                "cell_color" => "#008080",
                "life_id" => 2
            ],
            [
                "cell_detail" => "Seventeenth Cell",
                "cell_no" => 17,
                "cell_point" => 10,
                "cell_color" => "#800000",
                "life_id" => 2
            ],
            [
                "cell_detail" => "Eighteenth Cell",
                "cell_no" => 18,
                "cell_point" => 6,
                "cell_color" => "#808000",
                "life_id" => 2
            ],
            [
                "cell_detail" => "Nineteenth Cell",
                "cell_no" => 19,
                "cell_point" => 9,
                "cell_color" => "#FF7F50",
                "life_id" => 2
            ],
            [
                "cell_detail" => "Twentieth Cell",
                "cell_no" => 20,
                "cell_point" => 10,
                "cell_color" => "#808080",
                "life_id" => 2
            ],
            [
                "cell_detail" => "First Cell",
                "cell_no" => 1,
                "cell_point" => 10,
                "cell_color" => "#FF0000",
                "life_id" => 3
            ],
            [
                "cell_detail" => "Second Cell",
                "cell_no" => 2,
                "cell_point" => 5,
                "cell_color" => "#0000FF",
                "life_id" => 3
            ],
            [
                "cell_detail" => "Third Cell",
                "cell_no" => 3,
                "cell_point" => 0,
                "cell_color" => "#00FF00",
                "life_id" => 3
            ],
            [
                "cell_detail" => "Fourth Cell",
                "cell_no" => 4,
                "cell_point" => 5,
                "cell_color" => "#FFFF00",
                "life_id" => 3
            ],
            [
                "cell_detail" => "Fifth Cell",
                "cell_no" => 5,
                "cell_point" => 3,
                "cell_color" => "#FFA500",
                "life_id" => 3
            ],
            [
                "cell_detail" => "Sixth Cell",
                "cell_no" => 6,
                "cell_point" => 5,
                "cell_color" => "#FFC0CB",
                "life_id" => 3
            ],
            [
                "cell_detail" => "Seventh Cell",
                "cell_no" => 7,
                "cell_point" => 4,
                "cell_color" => "#800080",
                "life_id" => 3
            ],
            [
                "cell_detail" => "Eighth Cell",
                "cell_no" => 8,
                "cell_point" => 5,
                "cell_color" => "#A52A2A",
                "life_id" => 3
            ],
            [
                "cell_detail" => "Ninth Cell",
                "cell_no" => 9,
                "cell_point" => 3,
                "cell_color" => "#00FF00",
                "life_id" => 3
            ],
            [
                "cell_detail" => "Tenth Cell",
                "cell_no" => 10,
                "cell_point" => 7,
                "cell_color" => "#FF00FF",
                "life_id" => 3
            ],
            [
                "cell_detail" => "Eleventh Cell",
                "cell_no" => 11,
                "cell_point" => 8,
                "cell_color" => "#00FFFF",
                "life_id" => 3
            ],
            [
                "cell_detail" => "Twelfth Cell",
                "cell_no" => 12,
                "cell_point" => 6,
                "cell_color" => "#4B0082",
                "life_id" => 3
            ],
            [
                "cell_detail" => "Thirteenth Cell",
                "cell_no" => 13,
                "cell_point" => 9,
                "cell_color" => "#000000",
                "life_id" => 3
            ],
            [
                "cell_detail" => "Fourteenth Cell",
                "cell_no" => 14,
                "cell_point" => 2,
                "cell_color" => "#FFFFFF",
                "life_id" => 3
            ],
            [
                "cell_detail" => "Fifteenth Cell",
                "cell_no" => 15,
                "cell_point" => 1,
                "cell_color" => "#F5F5DC",
                "life_id" => 3
            ],
            [
                "cell_detail" => "Sixteenth Cell",
                "cell_no" => 16,
                "cell_point" => 7,
                "cell_color" => "#008080",
                "life_id" => 3
            ],
            [
                "cell_detail" => "Seventeenth Cell",
                "cell_no" => 17,
                "cell_point" => 10,
                "cell_color" => "#800000",
                "life_id" => 3
            ],
            [
                "cell_detail" => "Eighteenth Cell",
                "cell_no" => 18,
                "cell_point" => 6,
                "cell_color" => "#808000",
                "life_id" => 3
            ],
            [
                "cell_detail" => "Nineteenth Cell",
                "cell_no" => 19,
                "cell_point" => 9,
                "cell_color" => "#FF7F50",
                "life_id" => 3
            ],
            [
                "cell_detail" => "Twentieth Cell",
                "cell_no" => 20,
                "cell_point" => 10,
                "cell_color" => "#808080",
                "life_id" => 3
            ],
            [
                "cell_detail" => "First Cell",
                "cell_no" => 1,
                "cell_point" => 10,
                "cell_color" => "#FF0000",
                "life_id" => 4
            ],
            [
                "cell_detail" => "Second Cell",
                "cell_no" => 2,
                "cell_point" => 5,
                "cell_color" => "#0000FF",
                "life_id" => 4
            ],
            [
                "cell_detail" => "Third Cell",
                "cell_no" => 3,
                "cell_point" => 0,
                "cell_color" => "#00FF00",
                "life_id" => 4
            ],
            [
                "cell_detail" => "Fourth Cell",
                "cell_no" => 4,
                "cell_point" => 5,
                "cell_color" => "#FFFF00",
                "life_id" => 4
            ],
            [
                "cell_detail" => "Fifth Cell",
                "cell_no" => 5,
                "cell_point" => 3,
                "cell_color" => "#FFA500",
                "life_id" => 4
            ],
            [
                "cell_detail" => "Sixth Cell",
                "cell_no" => 6,
                "cell_point" => 5,
                "cell_color" => "#FFC0CB",
                "life_id" => 4
            ],
            [
                "cell_detail" => "Seventh Cell",
                "cell_no" => 7,
                "cell_point" => 4,
                "cell_color" => "#800080",
                "life_id" => 4
            ],
            [
                "cell_detail" => "Eighth Cell",
                "cell_no" => 8,
                "cell_point" => 5,
                "cell_color" => "#A52A2A",
                "life_id" => 4
            ],
            [
                "cell_detail" => "Ninth Cell",
                "cell_no" => 9,
                "cell_point" => 3,
                "cell_color" => "#00FF00",
                "life_id" => 4
            ],
            [
                "cell_detail" => "Tenth Cell",
                "cell_no" => 10,
                "cell_point" => 7,
                "cell_color" => "#FF00FF",
                "life_id" => 4
            ],
            [
                "cell_detail" => "Eleventh Cell",
                "cell_no" => 11,
                "cell_point" => 8,
                "cell_color" => "#00FFFF",
                "life_id" => 4
            ],
            [
                "cell_detail" => "Twelfth Cell",
                "cell_no" => 12,
                "cell_point" => 6,
                "cell_color" => "#4B0082",
                "life_id" => 4
            ],
            [
                "cell_detail" => "Thirteenth Cell",
                "cell_no" => 13,
                "cell_point" => 9,
                "cell_color" => "#000000",
                "life_id" => 4
            ],
            [
                "cell_detail" => "Fourteenth Cell",
                "cell_no" => 14,
                "cell_point" => 2,
                "cell_color" => "#FFFFFF",
                "life_id" => 4
            ],
            [
                "cell_detail" => "Fifteenth Cell",
                "cell_no" => 15,
                "cell_point" => 1,
                "cell_color" => "#F5F5DC",
                "life_id" => 4
            ],
            [
                "cell_detail" => "Sixteenth Cell",
                "cell_no" => 16,
                "cell_point" => 7,
                "cell_color" => "#008080",
                "life_id" => 4
            ],
            [
                "cell_detail" => "Seventeenth Cell",
                "cell_no" => 17,
                "cell_point" => 10,
                "cell_color" => "#800000",
                "life_id" => 4
            ],
            [
                "cell_detail" => "Eighteenth Cell",
                "cell_no" => 18,
                "cell_point" => 6,
                "cell_color" => "#808000",
                "life_id" => 4
            ],
            [
                "cell_detail" => "Nineteenth Cell",
                "cell_no" => 19,
                "cell_point" => 9,
                "cell_color" => "#FF7F50",
                "life_id" => 4
            ],
            [
                "cell_detail" => "Twentieth Cell",
                "cell_no" => 20,
                "cell_point" => 10,
                "cell_color" => "#808080",
                "life_id" => 4
            ],
        ];

        foreach ($data as $item) {
            $item['created_at'] = $now;
            $item['updated_at'] = $now;
            DB::table('cells')->insert($item);
        }
    }
}
