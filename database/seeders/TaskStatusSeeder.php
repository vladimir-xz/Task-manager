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
            'name' => 'Новый'
        ]);
        TaskStatus::firstOrCreate([
            'name' => 'В работе'
        ]);
        TaskStatus::firstOrCreate([
            'name' => 'На тестировании'
        ]);
        TaskStatus::firstOrCreate([
            'name' => 'Завершен'
        ]);
    }
}
