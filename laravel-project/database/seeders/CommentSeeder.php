<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;

class CommentSeeder extends Seeder
{
    public function run()
    {
        $comments = [
            [
                'user_id' => 1,
                'life_id' => 2,
                'comment' => 'This is the first comment'
            ],
            [
                'user_id' => 2,
                'life_id' => 1,
                'comment' => 'This is another comment'
            ],
            [
                'user_id' => 3,
                'life_id' => 1,
                'comment' => 'Here is a third comment'
            ],
            [
                'user_id' => 4,
                'life_id' => 1,
                'comment' => 'Comment number four'
            ],
            [
                'user_id' => 2,
                'life_id' => 3,
                'comment' => 'And this is the final comment'
            ],
        ];

        foreach ($comments as $data) {
            Comment::create($data);
        }
    }
}
