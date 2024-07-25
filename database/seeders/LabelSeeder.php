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
            'name' => 'ошибка',
            'description' => 'Какая-то ошибка в коде или проблема с функциональностью'
        ]);
        Label::firstOrCreate([
            'name' => 'документация',
            'description' => 'Задача которая касается документации'
        ]);
        Label::firstOrCreate([
            'name' => 'дубликат',
            'description' => 'Повтор другой задачи'
        ]);
        Label::firstOrCreate([
            'name' => 'доработка',
            'description' => 'Новая фича, которую нужно запилить'
        ]);
    }
}