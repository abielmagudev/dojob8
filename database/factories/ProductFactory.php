<?php

namespace Database\Factories;

use App\Models\Product\Kernel\MeasurementUnitsCatalog;
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
        return [
            'name' => $this->faker->unique()->languageCode(),
            'description' => $this->faker->optional()->sentence(),
            'measurement_unit' => MeasurementUnitsCatalog::abbreviations()->random(),
            'item_price_id' => $this->faker->optional()->numberBetween(1,10),
            'material_price' => $this->faker->randomFloat(2, 0.01, 999),
            'labor_price' => $this->faker->randomFloat(2, 0.01, 999),
            // 'unit_price' => ($material_price + $labor_price),
        ];
    }
}
