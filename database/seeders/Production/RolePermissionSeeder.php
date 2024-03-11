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
        $this->createPermissionsForClients($roles);
        $this->createPermissionsForContractors($roles);
        $this->createPermissionsForCrews($roles);
        $this->createPermissionsForJobs($roles);
        $this->createPermissionsForMembers($roles);
        $this->createPermissionsForUsers($roles);

        // OPERATIVE
        $this->createPermissionsForComments($roles);
        $this->createPermissionsForMedia($roles);
        $this->createPermissionsForInspections($roles);
        $this->createPermissionsForPayments($roles);
        $this->createPermissionsForWorkOrders($roles);
        $this->createPermissionsForXapi($roles);

        // APPLICATION
        $this->createPermissionsForExtensions($roles);
        $this->createPermissionsForHistory($roles);
        $this->createPermissionsForSearch($roles);
        $this->createPermissionsForSettings($roles);

        // PIVOT
        $this->createPermissionsForCrewMembers($roles);
        $this->createPermissionsForInspectionMembers($roles);
        $this->createPermissionsForJobExtensions($roles);
        $this->createPermissionsForWorkOrderMembers($roles);

    }



    // ROLES ---------------------------------------------------------------------------------------------------------------------------------

    protected function createRoles()
    {
        return [
            'SuperAdmin' => Role::create(['name' => 'SuperAdmin']),
            'administrator' => Role::create(['name' => 'administrator']),
            'manager' => Role::create(['name' => 'manager']),
            'coordinator' => Role::create(['name' => 'coordinator']),
            'assessor' => Role::create(['name' => 'assessor']),
            'crew member' => Role::create(['name' => 'crew member']),
            'contractor' => Role::create(['name' => 'contractor']),
            'agency' => Role::create(['name' => 'agency']),
            'payments' => Role::create(['name' => 'payments']),
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

        Permission::create(['name' => 'everything-admin']); // CRUD for admin users

        Permission::create(['name' => 'everything-SuperAdmin']); // CRUD for super admin users
    }




    // OPERATIVE 

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
            $roles['crew member'],
        ]);

        Permission::create(['name' => 'filter-comments'])->syncRoles([
            $roles['administrator'],
            $roles['payments'],
            $roles['manager'],
            $roles['coordinator'],
            $roles['assessor'],
            $roles['crew member'],
        ]);

        Permission::create(['name' => 'create-comments'])->syncRoles([
            $roles['administrator'],
            $roles['manager'],
            $roles['coordinator'],
            $roles['assessor'],
            $roles['crew member'],
        ]);

        Permission::create(['name' => 'edit-comments'])->syncRoles([
            $roles['administrator'],
            $roles['manager'],
            $roles['coordinator'],
            $roles['assessor'],
            $roles['crew member'],
        ]);

        Permission::create(['name' => 'delete-comments'])->syncRoles([
            $roles['administrator'],
        ]);
    }

    /**
     * Files
     */
    protected function createPermissionsForMedia($roles)
    {
        Permission::create(['name' => 'see-media'])->syncRoles([
            $roles['administrator'],
            $roles['payments'],
            $roles['manager'],
            $roles['coordinator'],
            $roles['assessor'],
            $roles['crew member'],
        ]);

        Permission::create(['name' => 'filter-media'])->syncRoles([
            $roles['administrator'],
            $roles['payments'],
            $roles['manager'],
            $roles['coordinator'],
            $roles['assessor'],
            $roles['crew member'],
        ]);

        Permission::create(['name' => 'create-media'])->syncRoles([
            $roles['administrator'],
            $roles['manager'],
            $roles['coordinator'],
            $roles['assessor'],
            $roles['crew member'],
        ]);

        Permission::create(['name' => 'edit-media'])->syncRoles([
            $roles['administrator'],
            $roles['manager'],
            $roles['coordinator'],
            $roles['assessor'],
            $roles['crew member'],
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
            $roles['crew member'],
            $roles['agency'],
        ]);

        Permission::create(['name' => 'filter-inspections'])->syncRoles([
            $roles['administrator'],
            $roles['payments'],
            $roles['manager'],
            $roles['coordinator'],
            $roles['crew member'],
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
            $roles['crew member'],
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
            $roles['crew member'],
            $roles['contractor'],
        ]);

        Permission::create(['name' => 'filter-work-orders'])->syncRoles([
            $roles['administrator'],
            $roles['payments'],
            $roles['manager'],
            $roles['coordinator'],
            $roles['assessor'],
            $roles['crew member'],
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
            $roles['crew member'],
        ]);

        Permission::create(['name' => 'delete-work-orders'])->syncRoles([
            $roles['administrator'],
        ]);
    }

    /**
     * XAPI (eXtension API)
     */
    public function createPermissionsForXapi(array $roles)
    {
        Permission::create(['name' => 'see-xapi'])->syncRoles([
            $roles['administrator'],
            $roles['payments'],
        ]);

        Permission::create(['name' => 'filter-xapi'])->syncRoles([
            $roles['administrator'],
            $roles['payments'],
        ]);

        Permission::create(['name' => 'create-xapi'])->syncRoles([
            $roles['administrator'],
        ]);

        Permission::create(['name' => 'edit-xapi'])->syncRoles([
            $roles['administrator'],
        ]);

        Permission::create(['name' => 'export-xapi'])->syncRoles([
            $roles['administrator'],
            $roles['payments'],
        ]);

        Permission::create(['name' => 'delete-xapi'])->syncRoles([
            $roles['administrator'],
        ]);

        Permission::create(['name' => 'restore-xapi']);

        Permission::create(['name' => 'force-delete-xapi']);
    }



    // APPLICATION ----------------------------------------------------------------------------------------------------------------------------

    /**
     * Extensions
     */
    public function createPermissionsForExtensions(array $roles)
    {
        Permission::create(['name' => 'see-extensions'])->syncRoles([
            $roles['administrator'],
            $roles['payments'],
        ]);

        Permission::create(['name' => 'filter-extensions'])->syncRoles([
            $roles['administrator'],
            $roles['payments'],
        ]);
    }

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
            $roles['crew member'],
            $roles['payments'],
        ]);
    }

    /**
     * Settings
     */
    protected function createPermissionsForSettings(array $roles)
    {
        Permission::create(['name' => 'see-settings']);

        Permission::create(['name' => 'edit-settings']);
    }



    // PIVOT ----------------------------------------------------------------------------------------------------------------------------------

    /**
     * Crew Members
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
     * Job Extensions
     */
    public function createPermissionsForJobExtensions(array $roles)
    {
        Permission::create(['name' => 'create-job-extensions'])->syncRoles([
            $roles['administrator'],
        ]);

        Permission::create(['name' => 'edit-job-extensions'])->syncRoles([
            $roles['administrator'],
        ]);

        Permission::create(['name' => 'delete-job-extensions'])->syncRoles([
            $roles['administrator'],
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
