<?php

namespace Database\Factories;

use App\Models\Inspector;
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
            'successful_inspections_required' => $this->faker->numberBetween(0, 2),
            'is_available' => (int) $this->faker->boolean(),
        ];
    }
}
