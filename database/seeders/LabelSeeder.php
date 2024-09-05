<?php

namespace Database\Seeders;

use App\Models\Label;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Label::firstOrCreate([
            'name' => 'normal',
            'description' => 'Обычный приоритет задачи'
        ]);
        Label::firstOrCreate([
            'name' => 'high',
            'description' => 'Высокий приоритет задачи'
        ]);
        Label::firstOrCreate([
            'name' => 'critical',
            'description' => 'Критично важная задача'
        ]);
        Label::firstOrCreate([
            'name' => 'error',
            'description' => 'Произошла ошибка',
            'system' => true
        ]);
        Label::firstOrCreate([
            'name' => 'new response',
            'description' => 'Новое сообщение',
            'system' => true
        ]);
    }
}
