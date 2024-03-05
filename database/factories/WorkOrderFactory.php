<?php

namespace Database\Factories;

use App\Models\WorkOrder;
use Illuminate\Database\Eloquent\Factories\Factory;

class WorkOrderFactory extends Factory
{
    public static $counter;
    
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $status = WorkOrder::collectionAllStatuses()->random();
        $rectification_type_random = WorkOrder::collectionAllTypes()->random();

        if( $rectification_type_random <> 'standard' && self::$counter >= 500 )
        {
            $rectification_type = $rectification_type_random;
            $rectification_id = mt_rand(1, 500);
        }

        self::$counter++;
            
        return [
            'ordered' => $this->faker->optional()->numberBetween(1, 5),
            'status' => $status,

            'scheduled_date' => $this->faker->optional()->dateTimeBetween('-2 years'),
            'working_at' =>  in_array($status, ['working','done','completed']) ? $this->faker->dateTimeBetween('-2 years') : null,
            'working_by' => in_array($status, ['working','done','completed']) ? mt_rand(1,100) : null,
            'done_at' => in_array($status, ['done','completed']) ? $this->faker->dateTimeBetween('-2 years') : null,
            'done_by' => in_array($status, ['done','completed']) ? mt_rand(1,10) : null,
            'completed_at' => in_array($status, ['completed', 'denialed']) ? $this->faker->dateTimeBetween('-2 years') : null,
            'completed_by' => in_array($status, ['completed', 'denialed']) ? mt_rand(1,10) : null,
            'permit_code' => $this->faker->optional()->ean13(),
            'notes' => $this->faker->optional()->sentence(),

            'rectification_type' => isset($rectification_type) ? $rectification_type : null,
            'rectification_id' => isset($rectification_id) ? $rectification_id : null,
            'client_id' => $this->faker->numberBetween(1, 500),
            'contractor_id' => $this->faker->optional()->numberBetween(1, 10),
            'crew_id' => $this->faker->optional()->numberBetween(1, 10),
            'job_id' => $this->faker->numberBetween(1, 10),
            'assessment_id' => null,
        ];
    }
}
