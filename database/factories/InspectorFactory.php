<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class InspectorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->randomElement(['City', 'Lytle', 'Rodriguez', 'Cps', 'Self']),
            'notes' => $this->faker->optional()->sentence(),
        ];
    }
}
