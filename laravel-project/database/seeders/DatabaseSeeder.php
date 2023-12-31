<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ImagesTableSeeder::class,
            UsersTableSeeder::class,
            LifeSeeder::class,
            CellSeeder::class,
            CommentSeeder ::class,
            NotificationSeeder::class,
            GameEventsTableSeeder::class,
            GamesTableSeeder::class,
            GameUsersTableSeeder::class,
        ]);
    }
}
