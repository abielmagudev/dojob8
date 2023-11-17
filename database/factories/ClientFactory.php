<?php

namespace Database\Factories;

use App\Helpers\CountryManager;
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
        $firstname = $this->faker->firstName();

        $lastname = $this->faker->lastName();

        $country = CountryManager::get( 
            $this->faker->randomElement( CountryManager::codes() )
        );

        // Temporary: only US
        $country = CountryManager::get('US');

        return [
            'name' => $firstname,
            'lastname' => $lastname,
            'fullname' => "{$firstname} {$lastname}",
            'street' => $this->faker->streetAddress(),
            'zip_code' => $this->faker->postcode(),
            'country_code' => $country->get('code'), // $this->faker->country(),
            'state_code' => $this->faker->randomElement( $country->get('states')->keys() ), // $this->faker->state(),
            'city' => $this->faker->city(),
            'phone_number' => $this->faker->optional()->phoneNumber(),
            'mobile_number' => $this->faker->optional()->phoneNumber(),
            'email' => $this->faker->optional()->email(),
            'notes' => $this->faker->optional()->text(),
        ];
    }
}
