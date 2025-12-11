<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Deal>
 */
class DealFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'customer_id' => 1, // Seeder 中会覆盖
            'owner_id' => 1,    // Seeder 中会覆盖
            'pipeline_stage_id' => 1, // Seeder 中会覆盖
            'amount' => $this->faker->randomFloat(2, 1000, 100000),
            'note' => $this->faker->paragraph,
        ];
    }
}
