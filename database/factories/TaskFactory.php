<?php

namespace Database\Factories;

use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\Sequence;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(),
            'description' => $this->faker->sentence(10),
            'status_id' => TaskStatus::all()->random(),
            'created_by_id' => User::all()->random(),
        ];
    }

    public function assignetToSequence()
    {
        return $this->sequence(
            ['assigned_to_id' => rand(1, 5)],
            ['assigned_to_id' => null],
        );
    }
}
