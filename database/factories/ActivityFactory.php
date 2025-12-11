<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Activity>
 */
class ActivityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = ['call', 'email', 'note', 'meeting'];
        return [
            'user_id' => 1, // Seeder 中可覆盖
            'related_type' => 'App\Models\Deal', // 示例，可随机
            'related_id' => 1, // Seeder 中覆盖
            'type' => $this->faker->randomElement($types),
            'content' => $this->faker->sentence,
        ];
    }
}
