<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->jobTitle(),
            'description' => $this->faker->optional()->sentence(),
            'approved_inspections_required' => $this->faker->numberBetween(0,3),
            'is_available' => (int) $this->faker->boolean(),
        ];
    }
}
