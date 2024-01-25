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
            'permit_code' => $this->faker->optional()->ean13(),
            'notes' => $this->faker->optional()->sentence(),
            'scheduled_date' => $this->faker->dateTimeBetween('-2 years'),
            'working_at' => WorkOrder::inCrewStatuses($status) ? $this->faker->dateTimeBetween('-2 years') : null,
            'done_at' => WorkOrder::inIncompleteStatuses($status) ? $this->faker->dateTimeBetween('-2 years') : null,
            'completed_at' => ! WorkOrder::inIncompleteStatuses($status) ? $this->faker->dateTimeBetween('-2 years') : null,
            'archived_at' => WorkOrder::inArchivedStatuses($status) ? $this->faker->dateTimeBetween('-2 years') : null,
            'payment' => $this->faker->randomElement([-1,0,1]),
            'created_by' => $this->faker->optional()->numberBetween(1, 10),
            'updated_by' => $this->faker->optional()->numberBetween(1, 10),
        ];
    }
}
