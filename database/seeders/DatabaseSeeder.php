<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            TaskStatusSeeder::class,
            LabelSeeder::class,
            TaskSeeder::class,
            TaskLabelSeeder::class,
            TaskCommentSeeder::class,
            TaskCommentUserSeeder::class
        ]);
    }
}
