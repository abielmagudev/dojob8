<?php

namespace Database\Seeders\Production;

use App\Models\Configuration;
use Illuminate\Database\Seeder;

class ExampleConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Configuration::create([
            'settings_json' => [
                'company_name' => 'Your company name',
                'city_name' => 'City Name',
                'state_code' => 'TX',
                'country_code' => 'US',
            ],
        ]);
    }
}
