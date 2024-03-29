<?php

namespace Database\Seeders\Production;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // ROLES
        $roles = $this->createRoles();

        // CATALOG
        $this->createPermissionsForAgencies($roles);
        $this->createPermissionsForCategories($roles);
        $this->createPermissionsForClients($roles);
        $this->createPermissionsForContractors($roles);
        $this->createPermissionsForCrews($roles);
        $this->createPermissionsForJobs($roles);
        $this->createPermissionsForMembers($roles);
        $this->createPermissionsForProducts($roles);
        $this->createPermissionsForUsers($roles);

        // OPERATIVE
        $this->createPermissionsForAssessments($roles);
        $this->createPermissionsForComments($roles);
        $this->createPermissionsForInspections($roles);
        $this->createPermissionsForMedia($roles);
        $this->createPermissionsForPayments($roles);
        $this->createPermissionsForWorkOrders($roles);

        // APPLICATION
        $this->createPermissionsForHistory($roles);
        $this->createPermissionsForSearch($roles);
        $this->createPermissionsForConfiguration($roles);

        // PIVOT
        $this->createPermissionsForCrewMembers($roles);
        $this->createPermissionsForInspectionMembers($roles);
        $this->createPermissionsForWorkOrderMembers($roles);

    }



    // ROLES ---------------------------------------------------------------------------------------------------------------------------------

    protected function createRoles()
    {
        return [
            'SuperAdmin' => Role::create(['name' => 'SuperAdmin']),
            'administrator' => Role::create(['name' => 'administrator']),
            'payments' => Role::create(['name' => 'payments']),
            'manager' => Role::create(['name' => 'manager']),
            'coordinator' => Role::create(['name' => 'coordinator']),
            'crew-member' => Role::create(['name' => 'crew-member']),
            'assessor' => Role::create(['name' => 'assessor']),
            'contractor' => Role::create(['name' => 'contractor']),
            'agency' => Role::create(['name' => 'agency']),
        ];
    }



    // CATALOG ---------------------------------------------------------------------------------------------------------------------------------

    /**
     * Agencies
     */
    protected function createPermissionsForAgencies(array $roles)
    {
        Permission::create(['name' => 'see-agencies'])->syncRoles([
            $roles['administrator'],
            $roles['payments'],
            $roles['manager'],
            $roles['coordinator'],
        ]);
        
        Permission::create(['name' => 'filter-agencies'])->syncRoles([
            $roles['administrator'],
            $roles['payments'],
            $roles['manager'],
            $roles['coordinator'],
        ]);

        Permission::create(['name' => 'create-agencies'])->syncRoles([
            $roles['administrator'],
            $roles['payments'],
            $roles['manager'],
        ]);

        Permission::create(['name' => 'edit-agencies'])->syncRoles([
            $roles['administrator'],
            $roles['payments'],
            $roles['manager'],
        ]);

        Permission::create(['name' => 'delete-agencies'])->syncRoles([
            $roles['administrator'],
        ]);

        Permission::create(['name' => 'restore-agencies']);

        Permission::create(['name' => 'force-delete-agencies']);
    }

    /**
     * Categories
     */
    protected function createPermissionsForCategories(array $roles)
    {
        Permission::create(['name' => 'see-categories'])->syncRoles([
            $roles['administrator'],
            $roles['payments'],
        ]);
        
        Permission::create(['name' => 'filter-categories'])->syncRoles([
            $roles['administrator'],
            $roles['payments'],
        ]);

        Permission::create(['name' => 'create-categories'])->syncRoles([
            $roles['administrator'],
            $roles['payments'],
        ]);

        Permission::create(['name' => 'edit-categories'])->syncRoles([
            $roles['administrator'],
            $roles['payments'],
        ]);

        Permission::create(['name' => 'delete-categories'])->syncRoles([
            $roles['administrator'],
        ]);
    }

    /**
     * Clients
     */
    protected function createPermissionsForClients(array $roles)
    {
        Permission::create(['name' => 'see-clients'])->syncRoles([
            $roles['administrator'],
            $roles['payments'],
            $roles['manager'],
            $roles['coordinator'],
            $roles['assessor'],
        ]);

        Permission::create(['name' => 'filter-clients'])->syncRoles([
            $roles['administrator'],
            $roles['payments'],
            $roles['manager'],
            $roles['coordinator'],
            $roles['assessor'],
        ]);

        Permission::create(['name' => 'create-clients'])->syncRoles([
            $roles['administrator'],
            $roles['payments'],
            $roles['manager'],
            $roles['coordinator'],
            $roles['assessor'],
        ]);

        Permission::create(['name' => 'edit-clients'])->syncRoles([
            $roles['administrator'],
            $roles['payments'],
            $roles['manager'],
            $roles['coordinator'],
            $roles['assessor'],
        ]);

        Permission::create(['name' => 'delete-clients'])->syncRoles([
            $roles['administrator'],
        ]);

        Permission::create(['name' => 'restore-clients']);

        Permission::create(['name' => 'force-delete-clients']);
    }

    /**
     * Contractors
     */
    public function createPermissionsForContractors(array $roles)
    {
        Permission::create(['name' => 'see-contractors'])->syncRoles([
            $roles['administrator'],
            $roles['payments'],
            $roles['manager'],
            $roles['coordinator'],
        ]);

        Permission::create(['name' => 'filter-contractors'])->syncRoles([
            $roles['administrator'],
            $roles['payments'],
            $roles['manager'],
            $roles['coordinator'],
        ]);

        Permission::create(['name' => 'create-contractors'])->syncRoles([
            $roles['administrator'],
            $roles['payments'],
            $roles['manager'],
        ]);

        Permission::create(['name' => 'edit-contractors'])->syncRoles([
            $roles['administrator'],
            $roles['payments'],
            $roles['manager'],
        ]);

        Permission::create(['name' => 'delete-contractors'])->syncRoles([
            $roles['administrator'],
        ]);

        Permission::create(['name' => 'restore-contractors']);

        Permission::create(['name' => 'force-delete-contractors']);
    }

    /**
     * Crews
     */
    protected function createPermissionsForCrews(array $roles)
    {
        Permission::create(['name' => 'see-crews'])->syncRoles([
            $roles['administrator'],
            $roles['manager'],
            $roles['coordinator'],
        ]);

        Permission::create(['name' => 'filter-crews'])->syncRoles([
            $roles['administrator'],
            $roles['manager'],
            $roles['coordinator'],
        ]);

        Permission::create(['name' => 'create-crews'])->syncRoles([
            $roles['administrator'],
            $roles['manager'],
        ]);

        Permission::create(['name' => 'edit-crews'])->syncRoles([
            $roles['administrator'],
            $roles['manager'],
        ]);

        Permission::create(['name' => 'delete-crews'])->syncRoles([
            $roles['administrator'],
        ]);

        Permission::create(['name' => 'restore-crews']);

        Permission::create(['name' => 'force-delete-crews']);
    }

    /**
     * Jobs
     */
    public function createPermissionsForJobs(array $roles)
    {
        Permission::create(['name' => 'see-jobs'])->syncRoles([
            $roles['administrator'],
            $roles['payments'],
            $roles['manager'],
        ]);

        Permission::create(['name' => 'filter-jobs'])->syncRoles([
            $roles['administrator'],
            $roles['payments'],
            $roles['manager'],
        ]);

        Permission::create(['name' => 'create-jobs'])->syncRoles([
            $roles['administrator'],
        ]);

        Permission::create(['name' => 'edit-jobs'])->syncRoles([
            $roles['administrator'],
        ]);

        Permission::create(['name' => 'delete-jobs'])->syncRoles([
            $roles['administrator'],
        ]);

        Permission::create(['name' => 'restore-jobs']);

        Permission::create(['name' => 'force-delete-jobs']);
    }

    /**
     * Members
     */
    protected function createPermissionsForMembers(array $roles)
    {
        Permission::create(['name' => 'see-members'])->syncRoles([
            $roles['administrator'],
            $roles['payments'],
            $roles['manager'],
            $roles['coordinator'],
        ]);

        Permission::create(['name' => 'filter-members'])->syncRoles([
            $roles['administrator'],
            $roles['payments'],
            $roles['manager'],
            $roles['coordinator'],
        ]);

        Permission::create(['name' => 'create-members'])->syncRoles([
            $roles['administrator'],
            $roles['manager'],
        ]);

        Permission::create(['name' => 'edit-members'])->syncRoles([
            $roles['administrator'],
            $roles['manager'],
        ]);

        Permission::create(['name' => 'delete-members'])->syncRoles([
            $roles['administrator'],
        ]);

        Permission::create(['name' => 'restore-members']);

        Permission::create(['name' => 'force-delete-members']);
    }

    /**
     *  Users
     */
    protected function createPermissionsForUsers(array $roles)
    {
        Permission::create(['name' => 'see-users'])->syncRoles([
            $roles['administrator'],
        ]);

        Permission::create(['name' => 'filter-users'])->syncRoles([
            $roles['administrator'],
        ]);

        Permission::create(['name' => 'create-users'])->syncRoles([
            $roles['administrator'],
        ]);

        Permission::create(['name' => 'edit-users'])->syncRoles([
            $roles['administrator'],
        ]);

        Permission::create(['name' => 'delete-users'])->syncRoles([
            $roles['administrator'],
        ]);

        Permission::create(['name' => 'restore-users']);

        Permission::create(['name' => 'force-delete-users']);
    }



    // OPERATIVE 

    /**
     * Assessments
     */
    protected function createPermissionsForAssessments($roles)
    {
        Permission::create(['name' => 'see-assessments'])->syncRoles([
            $roles['administrator'],
            $roles['payments'],
            $roles['manager'],
            $roles['coordinator'],
            $roles['assessor'],
        ]);

        Permission::create(['name' => 'filter-assessments'])->syncRoles([
            $roles['administrator'],
            $roles['payments'],
            $roles['manager'],
            $roles['coordinator'],
            $roles['assessor'],
        ]);

        Permission::create(['name' => 'create-assessments'])->syncRoles([
            $roles['administrator'],
            $roles['manager'],
            $roles['coordinator'],
            $roles['assessor'],
        ]);

        Permission::create(['name' => 'edit-assessments'])->syncRoles([
            $roles['administrator'],
            $roles['manager'],
            $roles['coordinator'],
            $roles['assessor'],
        ]);

        Permission::create(['name' => 'delete-assessments'])->syncRoles([
            $roles['administrator'],
        ]);
    }

    /**
     * Comments
     */
    protected function createPermissionsForComments($roles)
    {
        Permission::create(['name' => 'see-comments'])->syncRoles([
            $roles['administrator'],
            $roles['payments'],
            $roles['manager'],
            $roles['coordinator'],
            $roles['assessor'],
            $roles['crew-member'],
        ]);

        Permission::create(['name' => 'filter-comments'])->syncRoles([
            $roles['administrator'],
            $roles['payments'],
            $roles['manager'],
            $roles['coordinator'],
            $roles['assessor'],
            $roles['crew-member'],
        ]);

        Permission::create(['name' => 'create-comments'])->syncRoles([
            $roles['administrator'],
            $roles['manager'],
            $roles['coordinator'],
            $roles['assessor'],
            $roles['crew-member'],
        ]);

        Permission::create(['name' => 'edit-comments'])->syncRoles([
            $roles['administrator'],
            $roles['manager'],
            $roles['coordinator'],
            $roles['assessor'],
            $roles['crew-member'],
        ]);

        Permission::create(['name' => 'delete-comments'])->syncRoles([
            $roles['administrator'],
        ]);
    }

    /**
     * Media Files
     */
    protected function createPermissionsForMedia($roles)
    {
        Permission::create(['name' => 'see-media'])->syncRoles([
            $roles['administrator'],
            $roles['payments'],
            $roles['manager'],
            $roles['coordinator'],
            $roles['assessor'],
            $roles['crew-member'],
        ]);

        Permission::create(['name' => 'filter-media'])->syncRoles([
            $roles['administrator'],
            $roles['payments'],
            $roles['manager'],
            $roles['coordinator'],
            $roles['assessor'],
            $roles['crew-member'],
        ]);

        Permission::create(['name' => 'create-media'])->syncRoles([
            $roles['administrator'],
            $roles['manager'],
            $roles['coordinator'],
            $roles['assessor'],
            $roles['crew-member'],
        ]);

        Permission::create(['name' => 'edit-media'])->syncRoles([
            $roles['administrator'],
            $roles['manager'],
            $roles['coordinator'],
            $roles['assessor'],
            $roles['crew-member'],
        ]);

        Permission::create(['name' => 'delete-media'])->syncRoles([
            $roles['administrator'],
            $roles['manager'],
        ]);
    }
    
    /**
     * Inspections
     */
    protected function createPermissionsForInspections(array $roles)
    {
        Permission::create(['name' => 'see-inspections'])->syncRoles([
            $roles['administrator'],
            $roles['payments'],
            $roles['manager'],
            $roles['coordinator'],
            $roles['crew-member'],
            $roles['agency'],
        ]);

        Permission::create(['name' => 'filter-inspections'])->syncRoles([
            $roles['administrator'],
            $roles['payments'],
            $roles['manager'],
            $roles['coordinator'],
            $roles['crew-member'],
            $roles['agency'],
        ]);

        Permission::create(['name' => 'create-inspections'])->syncRoles([
            $roles['administrator'],
            $roles['manager'],
            $roles['coordinator'],
        ]);

        Permission::create(['name' => 'edit-inspections'])->syncRoles([
            $roles['administrator'],
            $roles['manager'],
            $roles['crew-member'],
            $roles['coordinator'],
        ]);

        Permission::create(['name' => 'delete-inspections'])->syncRoles([
            $roles['administrator'],
        ]);
    }

    /**
     * Payments
     */
    protected function createPermissionsForPayments(array $roles)
    {
        Permission::create(['name' => 'see-payments'])->syncRoles([
            $roles['administrator'],
            $roles['payments'],
        ]);

        Permission::create(['name' => 'filter-payments'])->syncRoles([
            $roles['administrator'],
            $roles['payments'],
        ]);

        Permission::create(['name' => 'create-payments'])->syncRoles([
            $roles['administrator'],
            $roles['payments'],
        ]);

        Permission::create(['name' => 'edit-payments'])->syncRoles([
            $roles['administrator'],
            $roles['payments'],
        ]);

        Permission::create(['name' => 'delete-payments'])->syncRoles([
            $roles['administrator'],
            $roles['payments'],
        ]);
    }

    /**
     * Products
     */
    protected function createPermissionsForProducts(array $roles)
    {
        Permission::create(['name' => 'see-products'])->syncRoles([
            $roles['administrator'],
            $roles['payments'],
        ]);

        Permission::create(['name' => 'filter-products'])->syncRoles([
            $roles['administrator'],
            $roles['payments'],
        ]);

        Permission::create(['name' => 'create-products'])->syncRoles([
            $roles['administrator'],
            $roles['payments'],
        ]);

        Permission::create(['name' => 'edit-products'])->syncRoles([
            $roles['administrator'],
            $roles['payments'],
        ]);

        Permission::create(['name' => 'delete-products'])->syncRoles([
            $roles['administrator'],
            $roles['payments'],
        ]);

        Permission::create(['name' => 'restore-products']);

        Permission::create(['name' => 'force-delete-products']);
    }

    /**
     * Work Orders
     */
    protected function createPermissionsForWorkOrders(array $roles)
    {
        Permission::create(['name' => 'see-work-orders'])->syncRoles([
            $roles['administrator'],
            $roles['payments'],
            $roles['manager'],
            $roles['coordinator'],
            $roles['assessor'],
            $roles['crew-member'],
            $roles['contractor'],
        ]);

        Permission::create(['name' => 'filter-work-orders'])->syncRoles([
            $roles['administrator'],
            $roles['payments'],
            $roles['manager'],
            $roles['coordinator'],
            $roles['assessor'],
            $roles['crew-member'],
            $roles['contractor'],
        ]);

        Permission::create(['name' => 'create-work-orders'])->syncRoles([
            $roles['administrator'],
            $roles['manager'],
            $roles['coordinator'],
            $roles['assessor'],
        ]);

        Permission::create(['name' => 'edit-work-orders'])->syncRoles([
            $roles['administrator'],
            $roles['manager'],
            $roles['coordinator'],
            $roles['assessor'],
            $roles['crew-member'],
        ]);

        Permission::create(['name' => 'delete-work-orders'])->syncRoles([
            $roles['administrator'],
        ]);
    }


    // APPLICATION ----------------------------------------------------------------------------------------------------------------------------

    /**
     * History
     */
    protected function createPermissionsForHistory(array $roles)
    {
        Permission::create(['name' => 'see-history'])->syncRoles([
            $roles['administrator'],
        ]);

        Permission::create(['name' => 'filter-history'])->syncRoles([
            $roles['administrator'],
        ]);

        Permission::create(['name' => 'delete-history']);
    }

    /**
     * Search
     */
    protected function createPermissionsForSearch(array $roles)
    {
        Permission::create(['name' => 'search'])->syncRoles([
            $roles['administrator'],
            $roles['payments'],
            $roles['manager'],
            $roles['coordinator'],
            $roles['assessor'],
            $roles['crew-member'],
        ]);
    }

    /**
     * Settings
     */
    protected function createPermissionsForConfiguration(array $roles)
    {
        Permission::create(['name' => 'see-configuration'])->syncRoles([
            $roles['administrator'],
        ]);

        Permission::create(['name' => 'create-configuration'])->syncRoles([
            $roles['administrator'],
        ]);

        Permission::create(['name' => 'edit-configuration'])->syncRoles([
            $roles['administrator'],
        ]);

        Permission::create(['name' => 'delete-configuration'])->syncRoles([
            $roles['administrator'],
        ]);
    }



    // PIVOT ----------------------------------------------------------------------------------------------------------------------------------

    /**
     * crew-members
     */
    protected function createPermissionsForCrewMembers(array $roles)
    {
        Permission::create(['name' => 'edit-crew-members'])->syncRoles([
            $roles['administrator'],
            $roles['manager'],
        ]);
    }

    /**
     * Inspection Members
     */
    protected function createPermissionsForInspectionMembers(array $roles)
    {
        Permission::create(['name' => 'edit-inspection-members'])->syncRoles([
            $roles['administrator'],
            $roles['manager'],
        ]);
    }

    /**
     * Work Order Members
     */
    protected function createPermissionsForWorkOrderMembers(array $roles)
    {
        Permission::create(['name' => 'edit-work-order-members'])->syncRoles([
            $roles['administrator'],
            $roles['manager'],
        ]);
    }
}
