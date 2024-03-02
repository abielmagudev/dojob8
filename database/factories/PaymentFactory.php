<?php

namespace Database\Factories;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'status' => $this->faker->randomElement( Payment::collectionAllStatuses()->toArray() ),
            'work_order_id' => $this->faker->unique()->numberBetween(1,1000),
        ];
    }
}
