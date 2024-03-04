<?php

namespace Database\Seeders\Development;

use App\Models\Crew;
use App\Models\Inspection;
use Illuminate\Database\Seeder;

class InspectionMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $crews = Crew::with('members')->get();

        foreach(Inspection::all() as $inspection)
        {
            $crew = $crews->only( $inspection->crew_id )->first();
            
            if( $crew && $crew->hasMembers() ) {
                $inspection->members()->attach( $crew->members->pluck('id') );
            }
        }
    }
}
