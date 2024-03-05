<?php

namespace Database\Factories;

use App\Models\Assessment;
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
            'status' => Assessment::INITIAL_STATUS,
            'scheduled_date' => $this->faker->dateTimeBetween('-2 years'),
            'ordered' => $this->faker->optional()->numberBetween(1, 10),
            'notes' => $this->faker->optional()->text(),
            'client_id' => $this->faker->numberBetween(1, 500),
            'crew_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
