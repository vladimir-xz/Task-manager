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
            'name' => 'error',
            'description' => 'Какая-то ошибка в коде или проблема с функциональностью'
        ]);
        Label::firstOrCreate([
            'name' => 'documentation',
            'description' => 'Задача которая касается документации'
        ]);
        Label::firstOrCreate([
            'name' => 'critical',
            'description' => 'Критично важная задача'
        ]);
        Label::firstOrCreate([
            'name' => 'modification',
            'description' => 'Новая фича, которую нужно запилить'
        ]);
    }
}
