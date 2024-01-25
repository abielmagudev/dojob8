<?php

namespace Database\Factories;

use App\Models\Crew;
use Illuminate\Database\Eloquent\Factories\Factory;

class CrewFactory extends Factory
{
    public function definition()
    {
        $crew_tasks = null;

        if( $this->faker->boolean() )
        {
            $crew_tasks = $this->faker->boolean() 
                        ? json_encode( Crew::getAllTasks()->toArray() ) 
                        : json_encode([ Crew::getAllTasks()->random() ]); 
        }

        return [
            'name' => strtoupper($this->faker->domainName()),
            'description' => $this->faker->optional()->sentence(),
            'tasks_json' => $crew_tasks,
            'background_color_hex' => $this->faker->hexColor(),
            'text_color_hex' => $this->faker->hexColor(),
            'lead_member_id' => $this->faker->optional()->numberBetween(1, 35),
            'is_active' => $this->faker->boolean(),
        ];
    }
}
