<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->firstName(),
            'lastname' => $this->faker->lastName(),
            'address' => $this->faker->address(),
            'zip_code' => $this->faker->postcode(),
            'city' => $this->faker->city(),
            'state' => $this->faker->state(),
            'country' => $this->faker->country(),
            'phone_number' => $this->faker->optional()->phoneNumber(),
            'mobile_number' => $this->faker->optional()->phoneNumber(),
            'email' => $this->faker->optional()->email(),
            'notes' => $this->faker->optional()->text(),
        ];
    }
}
