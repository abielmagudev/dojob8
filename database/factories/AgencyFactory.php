<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AgencyFactory extends Factory
{
    public $agency_names = [
        'ACCOG',
        'CITY',
        'CPS',
    ];

    public function definition()
    {
        $agency_name = current($this->agency_names);

        next($this->agency_names);
        
        return [
            'name' => $agency_name,
            'email' => $this->faker->optional()->companyEmail(),
            'mobile_number' => $this->faker->optional()->phoneNumber(),
            'phone_number' => $this->faker->optional()->phoneNumber(),
            'notes' => $this->faker->optional()->sentence(),
        ];
    }
}
