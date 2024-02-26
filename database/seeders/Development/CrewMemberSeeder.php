<?php

namespace Database\Seeders\Development;

use App\Models\CrewMember;
use Illuminate\Database\Seeder;

class CrewMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CrewMember::factory(25)->create();
    }
}
