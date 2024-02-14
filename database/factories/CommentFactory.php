<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'content' => $this->faker->sentences(2, true),
            'user_id' => $this->faker->numberBetween(1, 10),
            'work_order_id' => $this->faker->numberBetween(1, 1000),
        ];
    }
}
