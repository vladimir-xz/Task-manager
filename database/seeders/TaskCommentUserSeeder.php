<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TaskComment;

class TaskCommentUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 8; $i++) {
            TaskComment::all()->random()->recipients()->sync([
                rand(1, 4),
                rand(1, 4)
            ]);
        }
    }
}
