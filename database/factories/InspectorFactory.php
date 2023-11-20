<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class InspectorFactory extends Factory
{
    public $fake_names = [
        'City', 
        'Lyte', 
        'Roez', 
        'CPS', 
        'UsC', 
        'SATx', 
    ];

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->randomElement( $this->fake_names ),
            'notes' => $this->faker->optional()->sentence(),
        ];
    }
}
