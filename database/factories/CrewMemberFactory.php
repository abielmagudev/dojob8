<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CrewMemberFactory extends Factory
{
    public function definition()
    {
        return [
            'crew_id' => $this->faker->randomNumber(1,10),
            'member_id' => $this->faker->randomNumber(1,25),
        ];
    }
}
