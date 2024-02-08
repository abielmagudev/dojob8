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
            'approved_inspections_required_count' => $this->faker->numberBetween(0, 2),
            'agencies_generate_inspections_json' => $this->faker->boolean() ? json_encode( $this->faker->randomElements([1,2,3], mt_rand(1,3)) ) : null,
            'is_active' => (int) $this->faker->boolean(),
        ];
    }
}
