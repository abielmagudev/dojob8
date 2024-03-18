<?php

namespace Database\Seeders\Production;

use App\Models\Settings;
use Illuminate\Database\Seeder;

class ExampleSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Settings::create([
            'data_json' => json_encode([
                'company_name' => 'Your company name',
                'city_name' => 'City Name',
                'state_code' => 'TX',
                'country_code' => 'US',
            ]),
        ]);
    }
}
