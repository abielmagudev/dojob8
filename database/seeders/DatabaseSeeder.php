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
            ClientSeeder::class,
            CrewSeeder::class,
            ExtensionSeeder::class,
            InspectionSeeder::class,
            InspectorSeeder::class,
            IntermediarySeeder::class,
            JobSeeder::class,
            MemberSeeder::class,
            UserSeeder::class,
            WorkOrderSeeder::class,
        ]);
    }
}
