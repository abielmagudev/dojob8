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
        $status = $this->faker->randomElement( WorkOrder::getAllFormStatuses() );
        
        $scheduled_date = $this->faker->optional()->dateTimeBetween('-2 years');
        
        if( $rework_id = $this->faker->optional()->numberBetween(1, 500) )
        {
            if(! WorkOrder::exists($rework_id) )
            {
                $rework_id = null;
            }
        }

        if( $warranty_id = $this->faker->optional()->numberBetween(1, 500) )
        {
            if(! WorkOrder::exists($warranty_id) )
            {
                $warranty_id = null;
            }
        }
            
        return [
            'ordered' => $this->faker->optional()->numberBetween(1, 5),
            'status' => is_null($scheduled_date) ? 'pending' : $status,
            'payment_status' => WorkOrder::inStatusesForPayment($status) ? $this->faker->randomElement( WorkOrder::getPaymentStatuses() ) : WorkOrder::initialPaymentStatus(),
            'inspection_status' => WorkOrder::initialInspectionStatus(),

            'scheduled_date' => $scheduled_date,
            'working_at' => in_array($status, ['working','done','completed']) ? $this->faker->dateTimeBetween('-2 years') : null,
            'done_at' => in_array($status, ['done','completed']) ? $this->faker->dateTimeBetween('-2 years') : null,
            'completed_at' => WorkOrder::inClosedStatuses($status) ? $this->faker->dateTimeBetween('-2 years') : null,
            'working_by' => in_array($status, ['working','done','completed']) ? mt_rand(1,100) : null,
            'done_by' => in_array($status, ['done','completed']) ? mt_rand(1,10) : null,
            'completed_by' => WorkOrder::inClosedStatuses($status) && $status <> 'canceled' ? mt_rand(1,10) : null,

            'rework_id' => is_null($warranty_id) ? $rework_id : null,
            'warranty_id' => is_null($rework_id) ? $warranty_id : null,
            'client_id' => $this->faker->numberBetween(1, 500),
            'contractor_id' => $this->faker->optional()->numberBetween(1, 10),
            'crew_id' => $this->faker->numberBetween(1, 10),
            'job_id' => $this->faker->numberBetween(1, 10),

            'permit_code' => $this->faker->optional()->ean13(),
            'notes' => $this->faker->optional()->sentence(),
        ];
    }
}
