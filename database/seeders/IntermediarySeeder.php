<?php

namespace Database\Seeders;

use App\Models\Intermediary;
use Illuminate\Database\Seeder;

class IntermediarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Intermediary::factory(10)->create();
    }
}
