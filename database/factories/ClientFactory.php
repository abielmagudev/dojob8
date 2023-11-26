<?php

namespace Database\Factories;

use App\Suppliers\CountryManager;
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
        $first_name = $this->faker->firstName();

        $last_name = $this->faker->lastName();

        $country = CountryManager::get( 
            $this->faker->randomElement( CountryManager::codes() )
        );

        // Temporary: only US
        $country = CountryManager::get('US');

        return [
            'name' => $first_name,
            'last_name' => $last_name,
            'full_name' => "{$first_name} {$last_name}",
            'street' => $this->faker->streetAddress(),
            'zip_code' => $this->faker->postcode(),
            'country_code' => $country->get('code'), // $this->faker->country(),
            'state_code' => $this->faker->randomElement( $country->get('states')->keys() ), // $this->faker->state(),
            'city' => $this->faker->city(),
            'district' => str_pad($this->faker->numberBetween(1, 16), 2, 0, STR_PAD_LEFT),
            'phone_number' => $this->faker->phoneNumber(),
            'mobile_number' => $this->faker->optional()->phoneNumber(),
            'email' => $this->faker->optional()->email(),
            'notes' => $this->faker->optional()->text(),
        ];
    }
}
