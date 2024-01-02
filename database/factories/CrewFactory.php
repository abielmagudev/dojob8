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
        $crew_task_types = null;

        if( $this->faker->boolean() )
        {
            $crew_task_types = $this->faker->boolean() 
                            ? json_encode( Crew::getTaskTypes()->toArray() ) 
                            : json_encode([ Crew::getTaskTypes()->random() ]); 
        }

        return [
            'name' => strtoupper($this->faker->domainName()),
            'description' => $this->faker->optional()->sentence(),
            'task_types' => $crew_task_types,
            'background_color' => $this->faker->hexColor(),
            'text_color_mode' => $this->faker->randomElement( CrewPainter::getTextColorModes() ),
            'lead_member_id' => $this->faker->optional()->numberBetween(1, 35),
            'is_active' => $this->faker->boolean(),
        ];
    }
}
