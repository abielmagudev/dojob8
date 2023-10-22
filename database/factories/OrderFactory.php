<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'scheduled_date' => $this->faker->date(),
            'scheduled_time' => $this->faker->time(),
            'notes' => $this->faker->optional()->sentence(),
            'job_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
