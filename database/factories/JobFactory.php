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
            'success_inspections_required_count' => $this->faker->numberBetween(0, 2),
            'is_active' => (int) $this->faker->boolean(),
        ];
    }
}
