<?php

namespace Database\Seeders;

use Database\Seeders\Production\SetupSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * 
     * Examples 1
     * \App\Models\User::factory(10)->create();
     * 
     * Example 2
     * \App\Models\User::factory()->create(['attribute' => 'value']);
     * 
     * Example 3
     * $this->call([NameSeeder::class, ...]);
     * 
     */

    public function run()
    {
        if(! app()->environment('production') ) {
            $this->toDevelopment();
        } else {
            $this->toProduction();
        }
    }

    public function toDevelopment()
    {
        return $this->call([
            // Catalog
            AgencySeeder::class,
            ClientSeeder::class,
            ContractorSeeder::class,
            CrewSeeder::class,
            JobSeeder::class,
            MemberSeeder::class,
            SettingsSeeder::class,
            UserSeeder::class,
            
            // Operative
            WorkOrderSeeder::class,
            InspectionSeeder::class,
            CommentSeeder::class,

            // Pivot
            CrewMemberSeeder::class,
            InspectionMemberSeeder::class,
            MemberWorkOrderSeeder::class,

            // Overlast
            ExtensionSeeder::class,
        ]);
    }

    public function toProduction()
    {
        return $this->call([
            SetupSeeder::class,
            ExtensionSeeder::class,
        ]);
    }
}
