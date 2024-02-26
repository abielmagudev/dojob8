<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call( $this->baseSeeders() );

        $this->call( $this->enviromentSeeders() );
    }

    public function baseSeeders(): array
    {
        return [
            \Database\Seeders\Base\ExtensionSeeder::class,
            \Database\Seeders\Base\RolePermissionSeeder::class,
            \Database\Seeders\Base\SettingsSeeder::class,

            
        ];
    }

    public function enviromentSeeders(): array
    {
        return app()->environment('production') ? $this->productionSeeders() : $this->developmentSeeders();
    }

    public function developmentSeeders(): array
    {
        return [
            \Database\Seeders\Development\AgencySeeder::class,
            \Database\Seeders\Development\ClientSeeder::class,
            \Database\Seeders\Development\ContractorSeeder::class,
            \Database\Seeders\Development\CrewSeeder::class,
            \Database\Seeders\Development\JobSeeder::class,
            \Database\Seeders\Development\MemberSeeder::class,
            \Database\Seeders\Development\UserSeeder::class,
            \Database\Seeders\Development\WorkOrderSeeder::class,
            

            // Belongs to a work order
            \Database\Seeders\Development\CommentSeeder::class,
            \Database\Seeders\Development\InspectionSeeder::class,
            

            // Pivot tables
            \Database\Seeders\Development\CrewMemberSeeder::class,
            \Database\Seeders\Development\InspectionMemberSeeder::class,
            \Database\Seeders\Development\MemberWorkOrderSeeder::class,
            
        ];
    }

    public function productionSeeders(): array
    {
        return [
            \Database\Seeders\Production\MemberSeeder::class,
            \Database\Seeders\Production\UserSeeder::class,


        ];
    }
}

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
