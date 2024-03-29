<?php

namespace Database\Factories;

use App\Models\Inspection\Kernel\InspectionStatusCatalog;
use Illuminate\Database\Eloquent\Factories\Factory;

class InspectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {        
        return [
            'scheduled_date' => $this->faker->optional()->dateTimeBetween('-1 years'),
            'observations' => $this->faker->optional()->sentences(3, true),
            'inspector_name' => $this->faker->optional()->name(),
            'status' => InspectionStatusCatalog::all()->random(),
        ];
    }
}
