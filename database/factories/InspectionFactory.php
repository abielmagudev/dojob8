<?php

namespace Database\Factories;

use App\Models\Inspection;
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
            'agency_id' => $this->faker->numberBetween(1, 3),
            'crew_id' => $this->faker->optional()->numberBetween(1, 10),
            'work_order_id' => $this->faker->numberBetween(1, 500),
            'status' => $this->faker->randomElement( Inspection::collectionAllStatuses()->toArray() ) ,
        ];
    }
}
