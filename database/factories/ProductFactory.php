<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $material_price = $this->faker->randomFloat(2, 0.01, 999);
        $labor_price = $this->faker->randomFloat(2, 0.01, 999);

        return [
            'name' => $this->faker->unique()->currencyCode(),
            'item_price_id' => $this->faker->optional()->numberBetween(1,10),
            'material_price' => $material_price,
            'labor_price' => $labor_price,
            'unit_price' => ($material_price + $labor_price),
            'description' => $this->faker->optional()->sentence(),
        ];
    }
}
