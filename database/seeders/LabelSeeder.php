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
            'description' => 'Normal priority task'
        ]);
        Label::firstOrCreate([
            'name' => 'high',
            'description' => 'High priority task'
        ]);
        Label::firstOrCreate([
            'name' => 'critical',
            'description' => 'Critical task'
        ]);
        Label::firstOrCreate([
            'name' => 'docs',
            'description' => 'Documents and management'
        ]);
        Label::firstOrCreate([
            'name' => 'error',
            'description' => 'An error occured',
            'system' => true
        ]);
        Label::firstOrCreate([
            'name' => 'new response',
            'description' => 'New message',
            'system' => true
        ]);
    }
}
