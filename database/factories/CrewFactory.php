<?php

namespace Database\Factories;

use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;

class CrewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $operators = Member::operative()->get();

        return [
            'name' => strtoupper($this->faker->domainName()),
            'description' => $this->faker->optional()->sentence(),
            'color' => $this->faker->hexColor(),
            'is_active' => $this->faker->boolean(),
        ];
    }
}
