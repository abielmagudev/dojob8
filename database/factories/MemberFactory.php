<?php

namespace Database\Factories;

use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;

class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $full_name = [
            'name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName()
        ];

        return [
            'name' => $full_name['name'],
            'last_name' => $full_name['last_name'],
            'full_name' => implode(' ', $full_name),
            'birthdate' => $this->faker->optional()->date(),
            'phone_number' => $this->faker->optional()->phoneNumber(),
            'mobile_number' => $this->faker->optional()->phoneNumber(),
            'email' => $this->faker->optional()->email(),
            'position' => $this->faker->optional()->jobTitle(),
            'is_available' => $this->faker->boolean(),
            'is_crew_member' => $this->faker->boolean(),
            'notes' => $this->faker->optional()->sentences(3, true),
        ];
    }
}
