<?php

namespace Database\Factories;

use App\Helpers\CountryManager;
use Illuminate\Database\Eloquent\Factories\Factory;

class IntermediaryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $company_name = $this->faker->unique(true)->company;

        $country = CountryManager::get( 
            $this->faker->randomElement( CountryManager::codes() )
        );

        // Temporary: only US
        $country = CountryManager::get('US');

        return [
            'name' => $company_name,
            'alias' => wordInitials($company_name),
            'contact' => $this->faker->name,
            'phone_number' => $this->faker->phoneNumber(),
            'mobile_number' => $this->faker->optional()->phoneNumber(),
            'email' => $this->faker->companyEmail(),
            'street' => $this->faker->optional()->streetAddress(),
            'zip_code' => $this->faker->optional()->postcode(),
            'country_code' => $country->get('code'), // $this->faker->country(),
            'state_code' => $this->faker->randomElement( $country->get('states')->keys() ), // $this->faker->state(),
            'city' => $this->faker->city(),
            'notes' => $this->faker->optional()->text(),
        ];
    }
}
