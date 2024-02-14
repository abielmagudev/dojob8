<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SettingsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'data_json' => json_encode([
                'company_name' => 'Your company name',
                'city_name' => 'San Antonio',
                'state_code' => 'TX',
                'country_code' => 'US',
            ]),
        ];
    }
}
