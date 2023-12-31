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
        $status = $this->faker->randomElement( WorkOrder::getAllStatuses() );

        return [
            'status' => $status,
            'client_id' => $this->faker->numberBetween(1, 500),
            'contractor_id' => $this->faker->optional()->numberBetween(1, 10),
            'crew_id' => $this->faker->numberBetween(1, 10),
            'job_id' => $this->faker->numberBetween(1, 10),
            'notes' => $this->faker->optional()->sentence(),
            'scheduled_date' => $this->faker->dateTimeBetween('-3 years'),
            'working_at' => WorkOrder::isUnfinishedStatus($status) ? $this->faker->dateTimeBetween('-3 years') : null,
            'done_at' => WorkOrder::isUnfinishedStatus($status) ? $this->faker->dateTimeBetween('-3 years') : null,
            'completed_at' => WorkOrder::isFinishedStatus($status) ? $this->faker->dateTimeBetween('-3 years') : null,
            'closed_at' => WorkOrder::isFinishedStatus($status) ? $this->faker->dateTimeBetween('-3 years') : null,
            'created_by' => $this->faker->optional()->numberBetween(1, 10),
            'updated_by' => $this->faker->optional()->numberBetween(1, 10),
        ];
    }
}
