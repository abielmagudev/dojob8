<?php

namespace Database\Factories;

use App\Suppliers\CountryManager;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContractorFactory extends Factory
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
            'alias' => initials($company_name) . mt_rand(0,10),
            'contact_name' => $this->faker->name,
            'email' => $this->faker->optional()->companyEmail(),
            'mobile_number' => $this->faker->optional()->phoneNumber(),
            'phone_number' => $this->faker->optional()->phoneNumber(),
            'street' => $this->faker->streetAddress(),
            'city_name' => $this->faker->city(),
            'state_code' => $this->faker->randomElement( $country->get('states')->keys() ), // $this->faker->state(),
            'country_code' => $country->get('code'), // $this->faker->country(),
            'zip_code' => $this->faker->postcode(),
            'notes' => $this->faker->optional()->text(),
            'is_active' => (int) $this->faker->boolean(),
        ];
    }
}
