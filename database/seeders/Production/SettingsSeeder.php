<?php

namespace Database\Seeders\Production;

use App\Models\Settings;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
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
                'company_name' => 'GGA Construction',
                'city_name' => 'San Antonio',
                'state_code' => 'TX',
                'country_code' => 'US',
            ]),
        ]);
    }
}
