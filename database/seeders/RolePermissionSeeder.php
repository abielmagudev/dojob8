<?php

namespace Database\Seeders;

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
        $this->createPermissionsForUsers($roles);
        $this->createPermissionsForMembers($roles);
        $this->createPermissionsForCrews($roles);
        $this->createPermissionsForCrewMembers($roles);
        $this->createPermissionsForJobs($roles);
        $this->createPermissionsForContractors($roles);
        $this->createPermissionsForAgencies($roles);
        $this->createPermissionsForClients($roles);

        // OPERATIVE
        $this->createPermissionsForWorkOrders($roles);
        $this->createPermissionsForPayments($roles);
        $this->createPermissionsForInspections($roles);
        
        // DEFAULT
        $this->createPermissionsForExtensions($roles);
        $this->createPermissionsForHistory($roles);
        $this->createPermissionsForSettings($roles);
    }



    // ROLES -------------------------------------------------------------------

    protected function createRoles()
    {
        return [
            'SuperAdmin' => Role::create(['name' => 'SuperAdmin']),
            'administrator' => Role::create(['name' => 'administrator']),
            'manager' => Role::create(['name' => 'manager']),
            'coordinator' => Role::create(['name' => 'coordinator']),
            'assessor' => Role::create(['name' => 'assessor']),
            'worker' => Role::create(['name' => 'worker']),
            'contractor' => Role::create(['name' => 'contractor']),
            'agency' => Role::create(['name' => 'agency']),
            'payments' => Role::create(['name' => 'payments']),
        ];
    }


    // CATALOG -------------------------------------------------------------------

    /**
     *  Users
     */
    protected function createPermissionsForUsers(array $roles)
    {
        Permission::create(['name' => 'see-users'])->syncRoles([
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

    /**
     * Members
     */
    protected function createPermissionsForMembers(array $roles)
    {
        Permission::create(['name' => 'see-members'])->syncRoles([
            $roles['administrator'],
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
     * Crews
     */
    protected function createPermissionsForCrews(array $roles)
    {
        Permission::create(['name' => 'see-crews'])->syncRoles([
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
     * Crew Members
     */
    protected function createPermissionsForCrewMembers(array $roles)
    {
        Permission::create(['name' => 'edit-crew-members'])->syncRoles([
            $roles['administrator'],
            $roles['manager'],
        ]);

        Permission::create(['name' => 'delete-crew-members'])->syncRoles([
            $roles['administrator'],
            $roles['manager'],
        ]);
    }

    /**
     * Jobs
     */
    public function createPermissionsForJobs(array $roles)
    {
        Permission::create(['name' => 'see-jobs'])->syncRoles([
            $roles['administrator'],
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
     * Contractors
     */
    public function createPermissionsForContractors(array $roles)
    {
        Permission::create(['name' => 'see-contractors'])->syncRoles([
            $roles['administrator'],
            $roles['manager'],
            $roles['coordinator'],
        ]);

        Permission::create(['name' => 'create-contractors'])->syncRoles([
            $roles['administrator'],
            $roles['manager'],
        ]);

        Permission::create(['name' => 'edit-contractors'])->syncRoles([
            $roles['administrator'],
            $roles['manager'],
        ]);

        Permission::create(['name' => 'delete-contractors'])->syncRoles([
            $roles['administrator'],
        ]);

        Permission::create(['name' => 'restore-contractors']);

        Permission::create(['name' => 'force-delete-contractors']);
    }

    /**
     * Agencies
     */
    protected function createPermissionsForAgencies(array $roles)
    {
        Permission::create(['name' => 'see-agencies'])->syncRoles([
            $roles['administrator'],
            $roles['manager'],
            $roles['coordinator'],
        ]);

        Permission::create(['name' => 'create-agencies'])->syncRoles([
            $roles['administrator'],
            $roles['manager'],
        ]);

        Permission::create(['name' => 'edit-agencies'])->syncRoles([
            $roles['administrator'],
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
            $roles['manager'],
            $roles['coordinator'],
            $roles['assessor'],
        ]);

        Permission::create(['name' => 'create-clients'])->syncRoles([
            $roles['administrator'],
            $roles['manager'],
            $roles['coordinator'],
            $roles['assessor'],
        ]);

        Permission::create(['name' => 'edit-clients'])->syncRoles([
            $roles['administrator'],
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



    // OPERATIVE -------------------------------------------------------------------

    /**
     * Work Orders
     */
    protected function createPermissionsForWorkOrders(array $roles)
    {
        Permission::create(['name' => 'see-work-orders'])->syncRoles([
            $roles['administrator'],
            $roles['manager'],
            $roles['coordinator'],
            $roles['assessor'],
            $roles['worker'],
            $roles['contractor'],
            $roles['payments'],
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
        ]);

        Permission::create(['name' => 'delete-work-orders'])->syncRoles([
            $roles['administrator'],
        ]);

        Permission::create(['name' => 'restore-work-orders']);

        Permission::create(['name' => 'force-delete-work-orders']);
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

        Permission::create(['name' => 'edit-payments'])->syncRoles([
            $roles['administrator'],
            $roles['payments'],
        ]);
    }

    /**
     * Inspections
     */
    protected function createPermissionsForInspections(array $roles)
    {
        Permission::create(['name' => 'see-inspections'])->syncRoles([
            $roles['administrator'],
            $roles['manager'],
            $roles['coordinator'],
            $roles['worker'],
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
            $roles['coordinator'],
        ]);

        Permission::create(['name' => 'delete-inspections'])->syncRoles([
            $roles['administrator'],
        ]);

        Permission::create(['name' => 'restore-inspections']);

        Permission::create(['name' => 'force-delete-inspections']);
    }



    // DEFAULT -------------------------------------------------------------------

    /**
     * Extensions
     */
    public function createPermissionsForExtensions(array $roles)
    {
        Permission::create(['name' => 'see-extensions'])->syncRoles([
            $roles['administrator'],
            $roles['payments'],
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

    /**
     * History
     */
    protected function createPermissionsForHistory(array $roles)
    {
        Permission::create(['name' => 'see-history'])->syncRoles([
            $roles['administrator'],
        ]);

        Permission::create(['name' => 'edit-history']);

        Permission::create(['name' => 'delete-history']);

        Permission::create(['name' => 'restore-history']);

        Permission::create(['name' => 'force-delete-history']);
    }

    /**
     * Settings
     */
    protected function createPermissionsForSettings(array $roles)
    {
        Permission::create(['name' => 'see-settings']);

        Permission::create(['name' => 'edit-settings']);
    }
}
