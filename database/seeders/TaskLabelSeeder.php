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
            Task::all()->random()->labels()->saveMany([
                Label::all()->random(),
                Label::all()->random()
            ]);
        }
    }
}
