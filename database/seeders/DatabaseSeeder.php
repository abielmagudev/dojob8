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
        $this->call([
            // 
            AgencySeeder::class,
            ClientSeeder::class,
            CommentSeeder::class,
            ContractorSeeder::class,
            CrewSeeder::class,
            ExtensionSeeder::class,
            InspectionSeeder::class,
            JobSeeder::class,
            MemberSeeder::class,
            SettingsSeeder::class,
            UserSeeder::class,
            WorkOrderSeeder::class,

            //
            CrewMemberSeeder::class,
            InspectionMemberSeeder::class,
            MemberWorkOrderSeeder::class,
        ]);
    }
}
