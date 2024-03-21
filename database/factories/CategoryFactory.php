<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->currencyCode() . mt_rand(0,999),
            'description' => $this->faker->optional()->sentence(),
        ];
    }
}
