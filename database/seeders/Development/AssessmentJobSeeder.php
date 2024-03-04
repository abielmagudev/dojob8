<?php

namespace Database\Seeders\Development;

use App\Models\AssessmentJob;
use Illuminate\Database\Seeder;

class AssessmentJobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AssessmentJob::factory(500)->create();
    }
}
