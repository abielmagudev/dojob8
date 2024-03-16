<?php

namespace Database\Seeders\Development;

use App\Models\Agency;
use App\Models\Crew;
use App\Models\Inspection;
use App\Models\WorkOrder;
use Illuminate\Database\Seeder;

class InspectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $agencies = Agency::all();

        $crews = Crew::where('purposes_stringify', 'like', '%inspections%')->get();

        $work_orders_standard = WorkOrder::standard()->get();

        $inspections = Inspection::factory( mt_rand(1, 750) )->make();

        $inspections->each(function ($i) use ($agencies, $crews, $work_orders_standard) {
            $i->agency_id = $agencies->random()->id;
            $i->crew_id = $crews->random()->id;
            $i->work_order_id = $work_orders_standard->random()->id;
            $i->save();
        });
    }
}
