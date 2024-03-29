<?php

namespace Database\Seeders\Development;

use App\Models\Contractor;
use Illuminate\Database\Seeder;

class ContractorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Contractor::factory(10)->create();
    }
}
