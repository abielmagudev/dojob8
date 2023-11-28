<?php

namespace Database\Seeders;

use App\Models\Crew;
use Illuminate\Database\Seeder;

class CrewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Crew::factory(10)->create();
    }
}
