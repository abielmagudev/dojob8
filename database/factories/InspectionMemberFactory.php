<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class InspectionMemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'inspection_id' => $this->faker->randomNumber(1, 332),
            'member_id' => $this->faker->randomNumber(1, 35),
        ];
    }
}
