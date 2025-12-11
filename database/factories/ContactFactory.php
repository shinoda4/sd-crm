<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => 1,
            'name' => $this->faker->name,
            'title' => $this->faker->jobTitle,
            'email' => $this->faker->safeEmail,
            'phone' => $this->faker->phoneNumber,
        ];
    }

}
