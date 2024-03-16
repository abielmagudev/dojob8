<?php

namespace Database\Seeders\Development;

use App\Models\Payment;
use App\Models\WorkOrder;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $work_orders = WorkOrder::all();

        $payments = Payment::factory( $work_orders->count() )->make();

        $payments->each(function($p) use ($work_orders) {
            $p->work_order_id = $work_orders->random()->id;
            $p->save();
        });
    }
}
