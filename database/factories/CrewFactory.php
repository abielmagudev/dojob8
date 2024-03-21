<?php

namespace Database\Factories;

use App\Models\Crew;
use Illuminate\Database\Eloquent\Factories\Factory;

class CrewFactory extends Factory
{
    public function definition()
    {
        $colors_array = [
            $this->faker->hexColor(), // background
            $this->faker->hexColor(), // text
        ];

        return [
            'name' => strtoupper($this->faker->domainName()),
            'description' => $this->faker->optional()->sentence(),
            'colors_json' => $colors_array,
            'lead_member_id' => $this->faker->optional()->numberBetween(1, 35),
            'is_active' => $this->faker->boolean(),
        ];
    }
}
