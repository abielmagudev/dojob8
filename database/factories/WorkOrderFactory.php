<?php

namespace Database\Factories;

use App\Models\WorkOrder;
use Illuminate\Database\Eloquent\Factories\Factory;

class WorkOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'scheduled_date' => $this->faker->date(),
            'scheduled_time' => $this->faker->optional()->time(),
            'status' => $this->faker->optional()->randomElement( WorkOrder::getStatusKeys() ),
            'notes' => $this->faker->optional()->sentence(),
            'client_id' => $this->faker->numberBetween(1, 500),
            'crew_id' => $this->faker->numberBetween(1,10),
            'intermediary_id' => $this->faker->optional()->numberBetween(1,10),
            'job_id' => $this->faker->numberBetween(1, 10),
            'created_by' => $this->faker->optional()->numberBetween(1,10),
            'updated_by' => $this->faker->optional()->numberBetween(1,10),
        ];
    }
}
