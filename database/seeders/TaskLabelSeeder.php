<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\Label;

class TaskLabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 5; $i++) {
            Task::all()->random()->labels()->sync([
                rand(1, 4),
                rand(1, 4)
            ]);
        }
    }
}
