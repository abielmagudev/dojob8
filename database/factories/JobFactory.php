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
            'preconfigured_required_inspections' => $this->faker->boolean() ? json_encode( $this->faker->shuffle( $this->faker->randomElements([1,2,3], mt_rand(1,3)) ) ) : null,
            'is_active' => (int) $this->faker->boolean(),
        ];
    }
}
