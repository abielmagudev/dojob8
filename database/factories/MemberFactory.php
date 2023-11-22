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
        $fullname = [
            'name' => $this->faker->firstName(),
            'lastname' => $this->faker->lastName()
        ];

        return [
            'name' => $fullname['name'],
            'lastname' => $fullname['lastname'],
            'fullname' => implode(' ', $fullname),
            'birthdate' => $this->faker->optional()->date(),
            'phone_number' => $this->faker->optional()->phoneNumber(),
            'mobile_number' => $this->faker->optional()->phoneNumber(),
            'email' => $this->faker->optional()->email(),
            'position' => $this->faker->optional()->jobTitle(),
            'category' => $this->faker->randomElement( Member::getCategories() ),
            'scope' => $this->faker->randomElement( Member::getScopes() ),
            'is_active' => $this->faker->boolean(),
            'notes' => $this->faker->optional()->sentences(3, true),
        ];
    }
}
