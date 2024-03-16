<?php

namespace Database\Factories;

use App\Models\WorkOrder\Kernel\WorkOrderStatusCatalog;
use App\Models\WorkOrder\Kernel\WorkOrderTypeCatalog;
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
        $status = WorkOrderStatusCatalog::all()->random();
            
        return [
            'type' => WorkOrderTypeCatalog::all()->random(),
            'status' => $status,
            
            'permit_code' => $this->faker->optional()->ean13(),
            'notes' => $this->faker->optional()->sentence(),
            
            'scheduled_date' => $this->faker->optional()->dateTimeBetween('-2 years'),
            'ordered' => $this->faker->optional()->numberBetween(1, 10),
            'working_at' =>  in_array($status, ['working','done','completed']) ? $this->faker->dateTimeBetween('-2 years') : null,
            'done_at' => in_array($status, ['done','completed']) ? $this->faker->dateTimeBetween('-2 years') : null,
            'completed_at' => in_array($status, ['completed', 'denialed']) ? $this->faker->dateTimeBetween('-2 years') : null,
        ];
    }
}
