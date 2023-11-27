<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class InspectionFactory extends Factory
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
            'observations' => $this->faker->optional()->sentences(3, true),
            'notes' => $this->faker->optional()->sentence(),
            'is_approved' => $this->faker->optional()->numberBetween(0, 1),
            'inspector_id' => $this->faker->numberBetween(1, 3),
            'work_order_id' => $this->faker->numberBetween(1, 500),
        ];
    }
}
