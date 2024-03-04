<?php

namespace Database\Factories;

use App\Models\Purpose;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurposeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => Purpose::collectionAllNames()->random(),
            'crew_id' => $this->faker->numberBetween(1,10),
        ];
    }
}
