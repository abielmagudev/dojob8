<?php

namespace Database\Seeders\Development;

use App\Models\WorkOrder;
use Illuminate\Database\Seeder;

class WorkOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $work_orders = WorkOrder::factory(1000)->create();

        $work_orders->each(function ($wo) {
            $wo->assessment_id = mt_rand(0,1) ? mt_rand(1, 500) : null;
            $wo->save();
        });
    }
}
