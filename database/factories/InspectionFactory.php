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
        $scheduled_date = $this->faker->optional()->dateTimeBetween('-1 years');

        $crew_id = $this->faker->optional()->numberBetween(1, 10);
        
        return [
            'scheduled_date' => $scheduled_date,
            'observations' => $this->faker->optional()->sentences(3, true),
            'status' => Inspection::validateIsPendingStatus([$scheduled_date, $crew_id]) ? 'pending' : $this->faker->randomElement( Inspection::getFormStatuses()->toArray() ),
            'crew_id' => $crew_id,
            'inspector_id' => $this->faker->numberBetween(1, 3),
            'work_order_id' => $this->faker->numberBetween(1, 500),
        ];
    }
}
