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
            'scheduled_date' => $this->faker->optional()->dateTimeBetween('-2 years'),
            'ordered' => $this->faker->optional()->numberBetween(1, 10),
            'status' => Assessment::statuses()->random(),
            'notes' => $this->faker->optional()->text(),
            'is_walk_thru' => $this->faker->boolean(),
            'client_id' => $this->faker->numberBetween(1, 500),
            'contractor_id' => $this->faker->optional()->numberBetween(1, 10),
            'crew_id' => $this->faker->optional()->numberBetween(1, 10),
        ];
    }
}
