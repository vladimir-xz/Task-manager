<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Task;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()
            ->count(5)
            ->create();
        $this->call([
            TaskStatusSeeder::class,
        ]);
        Task::factory()
            ->assignetToSequence()
            ->count(5)
            ->create();
    }
}
