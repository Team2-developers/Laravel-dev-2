<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'img_id' => '1',
                'user_mail' => 'example1@example.com',
                'user_pass' => bcrypt('password123'),
                'user_name' => 'mac1',
                'birth' => '2000-01-01',
                'blood_type' => 'A',
                'height' => '100',
                'hobby' => 'reading',
                'episode1' => 'Episode 1',
                'episode2' => 'Episode 2',
                'episode3' => 'Episode 3',
                'episode4' => 'Episode 4',
                'episode5' => 'Episode 5',
                'token' => 'n8UhGcmeMEXoA6NbJxZ0yKCPmI4MvkacncHvffbg',
                'abilities' => 'General user'
            ], [
                'img_id' => '2',
                'user_mail' => 'example2@example.com',
                'user_pass' => bcrypt('password123'),
                'user_name' => 'mac1',
                'birth' => '2000-01-01',
                'blood_type' => 'A',
                'height' => '100',
                'hobby' => 'reading',
                'episode1' => 'Episode 1',
                'episode2' => 'Episode 2',
                'episode3' => 'Episode 3',
                'episode4' => 'Episode 4',
                'episode5' => 'Episode 5',
                'token' => 'kB4QYqjCZ7I5LKlqGoHDBaJn13VxwkaCKqMW3MLy',
                'abilities' => 'General user'
            ], [
                'img_id' => '3',
                'user_mail' => 'example3@example.com',
                'user_pass' => bcrypt('password123'),
                'user_name' => 'mac1',
                'birth' => '2000-01-01',
                'blood_type' => 'A',
                'height' => '100',
                'hobby' => 'reading',
                'episode1' => 'Episode 1',
                'episode2' => 'Episode 2',
                'episode3' => 'Episode 3',
                'episode4' => 'Episode 4',
                'episode5' => 'Episode 5',
                'token' => 'l3YPRd0UCGfYjwkYPTSd2rWKdI0XNj2u31gzWysq',
                'abilities' => 'General user'
            ], [
                'img_id' => '4',
                'user_mail' => 'example4@example.com',
                'user_pass' => bcrypt('password123'),
                'user_name' => 'mac1',
                'birth' => '2000-01-01',
                'blood_type' => 'A',
                'height' => '100',
                'hobby' => 'reading',
                'episode1' => 'Episode 1',
                'episode2' => 'Episode 2',
                'episode3' => 'Episode 3',
                'episode4' => 'Episode 4',
                'episode5' => 'Episode 5',
                'token' => '2dBqaDNIiTnvkPdRn5dRgC6sKypqclQvKGpo60aN',
                'abilities' => 'General user'
            ], [
                'img_id' => '9',
                'user_mail' => 'admin@example.com',
                'user_pass' => bcrypt('password0000000000'),
                'user_name' => 'operation',
                'birth' => '2000-01-01',
                'blood_type' => 'X',
                'height' => '1000',
                'hobby' => 'game',
                'episode1' => 'Episode 1',
                'episode2' => 'Episode 2',
                'episode3' => 'Episode 3',
                'episode4' => 'Episode 4',
                'episode5' => 'Episode 5',
                'token' => '',
                'abilities' => 'operation'
            ],
        ];

        foreach ($users as $user) {
            $user['token_deadline'] = Carbon::now()->addWeeks(10);
            User::create($user);
        }
    }
}
