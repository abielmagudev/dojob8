<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AssessmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ordered' => $this->faker->optional()->numberBetween(1,10),
            'scheduled_date' => $this->faker->dateTimeBetween('-2 years'),
            'notes' => $this->faker->optional()->text(),
            'client_id' => $this->faker->numberBetween(1, 500),
        ];
    }
}
