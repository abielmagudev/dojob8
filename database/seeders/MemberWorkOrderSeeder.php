<?php

namespace Database\Seeders;

use App\Models\Crew;
use App\Models\MemberWorkOrder;
use App\Models\WorkOrder;
use Illuminate\Database\Seeder;

class MemberWorkOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // MemberWorkOrder::factory(1000)->create();

        $crews = Crew::with('members')->get();

        foreach(WorkOrder::all() as $work_order)
        {
            $crew = $crews->only( $work_order->crew_id )->first();
            
            if(! $crew->hasMembers() ) {
                $work_order->workers()->attach( mt_rand(1, 35) );
            } else {
                $work_order->workers()->attach( $crew->members->pluck('id') );
            }
        }
    }
}
