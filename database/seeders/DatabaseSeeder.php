<?php

namespace Database\Seeders;

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
     * @return void
     */
    public function run()
    {
        if( app()->environment('production') )
        {
            $this->call(SetupSeeder::class);
        } 
        else
        {
            $this->call([
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
    }
}
