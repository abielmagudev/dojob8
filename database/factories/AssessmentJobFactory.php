<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AssessmentJobFactory extends Factory
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
            'assessment_id' => $this->faker->numberBetween(1,500),
            'job_id' => $this->faker->numberBetween(1,10),
        ];
    }
}
