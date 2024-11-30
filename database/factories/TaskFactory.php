<?php

namespace Database\Factories;

use App\Models\Priority;
use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Task>
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
            'name' => fake()->sentence(),
            'is_completed' => rand(0, 1),
            'priority_id' => rand(0, 1) === 0 ? NULL : Priority::pluck('id')->random(),
        ];
    }
}
