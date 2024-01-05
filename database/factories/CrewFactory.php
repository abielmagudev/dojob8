<?php

namespace Database\Factories;

use App\Models\Crew;
use App\Models\Crew\CrewPainter;
use Illuminate\Database\Eloquent\Factories\Factory;

class CrewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
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
            'tasks' => $crew_tasks,
            'background_color' => $this->faker->hexColor(),
            'text_color_mode' => $this->faker->randomElement( CrewPainter::getTextColorModes() ),
            'lead_member_id' => $this->faker->optional()->numberBetween(1, 35),
            'is_active' => $this->faker->boolean(),
        ];
    }
}
