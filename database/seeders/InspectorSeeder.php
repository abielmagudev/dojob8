<?php

namespace Database\Seeders;

use App\Models\Inspector;
use Illuminate\Database\Seeder;

class InspectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Inspector::factory(2)->create();
    }
}
