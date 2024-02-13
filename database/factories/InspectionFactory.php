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
        $attributes = [
            'scheduled_date' => $this->faker->optional()->dateTimeBetween('-1 years'),
            // 'crew_id' => $this->faker->optional()->numberBetween(1, 10),
        ];

        return [
            'scheduled_date' => $attributes['scheduled_date'],
            'observations' => $this->faker->optional()->sentences(3, true),
            'inspector_name' => $this->faker->optional()->name(),
            'agency_id' => $this->faker->numberBetween(1, 3),
            'crew_id' => $this->faker->optional()->numberBetween(1, 10),
            'work_order_id' => $this->faker->numberBetween(1, 500),
            'status' => ! Inspection::qualifyPendingStatus( $attributes ) 
                        ? $this->faker->randomElement( Inspection::allStatusesForm()->toArray() ) 
                        : 'pending',
        ];
    }
}
