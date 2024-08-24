<?php

namespace Database\Seeders;

use App\Models\TaskStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TaskStatus::firstOrCreate([
            'name' => 'New'
        ]);
        TaskStatus::firstOrCreate([
            'name' => 'Underway'
        ]);
        TaskStatus::firstOrCreate([
            'name' => 'Testing'
        ]);
        TaskStatus::firstOrCreate([
            'name' => 'Completed'
        ]);
    }
}
