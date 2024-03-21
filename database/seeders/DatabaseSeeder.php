<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class DatabaseSeeder extends Seeder
{
    public function run()
    {        
        $this->call( $this->productionSeeders() );

        if(! app()->environment('production') )
        {
            Auth::login( User::first() );

            $this->call( $this->developmentSeeders() );
        }
    }

    public function productionSeeders(): array
    {
        return [
            \Database\Seeders\Production\RolePermissionSeeder::class,
            \Database\Seeders\Production\MemberSuperAdminSeeder::class,
            \Database\Seeders\Production\ConfigurationSeeder::class,
            \Database\Seeders\Production\TaskSeeder::class,

        ];
    }

    public function developmentSeeders(): array
    {
        return [
            // Catalog
            \Database\Seeders\Development\AgencySeeder::class,
            \Database\Seeders\Development\AssessmentSeeder::class,
            \Database\Seeders\Development\CategorySeeder::class,
            \Database\Seeders\Development\ClientSeeder::class,
            \Database\Seeders\Development\ContractorSeeder::class,
            \Database\Seeders\Development\CrewSeeder::class,
            \Database\Seeders\Development\CrewTaskSeeder::class,
            \Database\Seeders\Development\JobSeeder::class,
            \Database\Seeders\Development\MemberSeeder::class,
            \Database\Seeders\Development\ProductSeeder::class,
            \Database\Seeders\Development\UserSeeder::class,
            \Database\Seeders\Development\WorkOrderSeeder::class,
            
            // Belongs to a work order
            \Database\Seeders\Development\PaymentSeeder::class,
            \Database\Seeders\Development\InspectionSeeder::class,
            \Database\Seeders\Development\CommentSeeder::class,
            
            // Pivot tables
            \Database\Seeders\Development\CrewMemberSeeder::class,
            \Database\Seeders\Development\InspectionMemberSeeder::class,
            \Database\Seeders\Development\MemberWorkOrderSeeder::class,

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
