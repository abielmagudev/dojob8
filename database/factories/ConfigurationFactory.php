<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ConfigurationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'data_json' => json_encode([
                'company_name' => $this->faker->catchPhrase(),
            ]),
            'created_by' => mt_rand(1,10),
            'updated_by' => mt_rand(1,10),
        ];
    }
}
