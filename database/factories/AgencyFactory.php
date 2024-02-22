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
            'notes' => $this->faker->optional()->sentence(),
            'created_by' => mt_rand(1,10),
            'updated_by' => mt_rand(1,10),
        ];
    }
}
