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
        $this->createPermissionsForDashboard($roles);
        $this->createPermissionsForExtensions($roles);
        $this->createPermissionsForHistory($roles);
        $this->createPermissionsForSettings($roles);
    }



    // ROLES -------------------------------------------------------------------

    protected function createRoles()
    {
        return [
            'SuperAdmin' => Role::create(['name' => 'SuperAdmin']),
            'admin' => Role::create(['name' => 'admin']),
            'director' => Role::create(['name' => 'director']),
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
            $roles['admin'],
        ]);

        Permission::create(['name' => 'create-users'])->syncRoles([
            $roles['admin'],
        ]);

        Permission::create(['name' => 'edit-users'])->syncRoles([
            $roles['admin'],
        ]);

        Permission::create(['name' => 'delete-users'])->syncRoles([
            $roles['admin'],
        ]);

        Permission::create(['name' => 'everything-admin']); // CRUD for admin users

        Permission::create(['name' => 'everything-SuperAdmin']); // CRUD for super admin users
    }

    /**
     * Members
     */
    protected function createPermissionsForMembers(array $roles)
    {
        Permission::create(['name' => 'see-members'])->syncRoles([
            $roles['admin'],
            $roles['director'],
            $roles['coordinator'],
        ]);

        Permission::create(['name' => 'create-members'])->syncRoles([
            $roles['admin'],
            $roles['director'],
        ]);

        Permission::create(['name' => 'edit-members'])->syncRoles([
            $roles['admin'],
            $roles['director'],
        ]);

        Permission::create(['name' => 'delete-members'])->syncRoles([
            $roles['admin'],
            $roles['director'],
        ]);
    }

    /**
     * Crews
     */
    protected function createPermissionsForCrews(array $roles)
    {
        Permission::create(['name' => 'see-crews'])->syncRoles([
            $roles['admin'],
            $roles['director'],
            $roles['coordinator'],
        ]);

        Permission::create(['name' => 'create-crews'])->syncRoles([
            $roles['admin'],
            $roles['director'],
        ]);

        Permission::create(['name' => 'edit-crews'])->syncRoles([
            $roles['admin'],
            $roles['director'],
        ]);

        Permission::create(['name' => 'delete-crews'])->syncRoles([
            $roles['admin'],
            $roles['director'],
        ]);
    }

    /**
     * Crew Members
     */
    protected function createPermissionsForCrewMembers(array $roles)
    {
        Permission::create(['name' => 'edit-crew-members'])->syncRoles([
            $roles['admin'],
            $roles['director'],
        ]);

        Permission::create(['name' => 'delete-crew-members'])->syncRoles([
            $roles['admin'],
            $roles['director'],
        ]);
    }

    /**
     * Jobs
     */
    public function createPermissionsForJobs(array $roles)
    {
        Permission::create(['name' => 'see-jobs'])->syncRoles([
            $roles['admin'],
            $roles['director'],
        ]);

        Permission::create(['name' => 'create-jobs'])->syncRoles([
            $roles['admin'],
        ]);

        Permission::create(['name' => 'edit-jobs'])->syncRoles([
            $roles['admin'],
        ]);

        Permission::create(['name' => 'delete-jobs'])->syncRoles([
            $roles['admin'],
        ]);
    }

    /**
     * Contractors
     */
    public function createPermissionsForContractors(array $roles)
    {
        Permission::create(['name' => 'see-contractors'])->syncRoles([
            $roles['admin'],
            $roles['director'],
            $roles['coordinator'],
        ]);

        Permission::create(['name' => 'create-contractors'])->syncRoles([
            $roles['admin'],
            $roles['director'],
        ]);

        Permission::create(['name' => 'contractors.edit'])->syncRoles([
            $roles['admin'],
            $roles['director'],
        ]);

        Permission::create(['name' => 'contractors.delete'])->syncRoles([
            $roles['admin'],
        ]);
    }

    /**
     * Agencies
     */
    protected function createPermissionsForAgencies(array $roles)
    {
        Permission::create(['name' => 'see-agencies'])->syncRoles([
            $roles['admin'],
            $roles['director'],
            $roles['coordinator'],
        ]);

        Permission::create(['name' => 'create-agencies'])->syncRoles([
            $roles['admin'],
            $roles['director'],
        ]);

        Permission::create(['name' => 'edit-agencies'])->syncRoles([
            $roles['admin'],
            $roles['director'],
        ]);

        Permission::create(['name' => 'delete-agencies'])->syncRoles([
            $roles['admin'],
        ]);
    }

    /**
     * Clients
     */
    protected function createPermissionsForClients(array $roles)
    {
        Permission::create(['name' => 'see-clients'])->syncRoles([
            $roles['admin'],
            $roles['director'],
            $roles['coordinator'],
            $roles['assessor'],
            $roles['worker'],
        ]);

        Permission::create(['name' => 'create-clients'])->syncRoles([
            $roles['admin'],
            $roles['director'],
            $roles['coordinator'],
            $roles['assessor'],
        ]);

        Permission::create(['name' => 'edit-clients'])->syncRoles([
            $roles['admin'],
            $roles['director'],
            $roles['coordinator'],
            $roles['assessor'],
        ]);

        Permission::create(['name' => 'delete-clients'])->syncRoles([
            $roles['admin'],
        ]);
    }



    // OPERATIVE -------------------------------------------------------------------

    /**
     * Work Orders
     */
    protected function createPermissionsForWorkOrders(array $roles)
    {
        Permission::create(['name' => 'see-work-orders'])->syncRoles([
            $roles['admin'],
            $roles['director'],
            $roles['coordinator'],
            $roles['assessor'],
            $roles['worker'],
            $roles['contractor'],
            $roles['payments'],
        ]);

        Permission::create(['name' => 'create-work-orders'])->syncRoles([
            $roles['admin'],
            $roles['director'],
            $roles['coordinator'],
            $roles['assessor'],
        ]);

        Permission::create(['name' => 'edit-work-orders'])->syncRoles([
            $roles['admin'],
            $roles['director'],
            $roles['coordinator'],
            $roles['assessor'],
        ]);

        Permission::create(['name' => 'delete-work-orders'])->syncRoles([
            $roles['admin'],
        ]);
    }

    /**
     * Payments
     */
    protected function createPermissionsForPayments(array $roles)
    {
        Permission::create(['name' => 'see-payments'])->syncRoles([
            $roles['admin'],
            $roles['payments'],
        ]);

        Permission::create(['name' => 'edit-payments'])->syncRoles([
            $roles['admin'],
            $roles['payments'],
        ]);
    }

    /**
     * Inspections
     */
    protected function createPermissionsForInspections(array $roles)
    {
        Permission::create(['name' => 'see-inspections'])->syncRoles([
            $roles['admin'],
            $roles['director'],
            $roles['coordinator'],
            $roles['worker'],
            $roles['agency'],
        ]);

        Permission::create(['name' => 'create-inspections'])->syncRoles([
            $roles['admin'],
            $roles['director'],
            $roles['coordinator'],
        ]);

        Permission::create(['name' => 'edit-inspections'])->syncRoles([
            $roles['admin'],
            $roles['director'],
            $roles['coordinator'],
        ]);

        Permission::create(['name' => 'delete-inspections'])->syncRoles([
            $roles['admin'],
        ]);
    }



    // DEFAULT -------------------------------------------------------------------

    /**
     * Dashboard
     */
    public function createPermissionsForDashboard(array $roles)
    {
        Permission::create(['name' => 'see-dashboard'])->syncRoles([
            $roles['admin'],
            $roles['director'],
            $roles['coordinator'],
            $roles['contractor'],
            $roles['agency'],
            $roles['payments'],
        ]);
    }

    /**
     * Extensions
     */
    public function createPermissionsForExtensions(array $roles)
    {
        Permission::create(['name' => 'see-extensions'])->syncRoles([
            $roles['admin'],
            $roles['payments'],
        ]);
    }

    /**
     * XAPI (eXtension API)
     */
    public function createPermissionsForXapi(array $roles)
    {
        Permission::create(['name' => 'see-xapi'])->syncRoles([
            $roles['admin'],
            $roles['payments'],
        ]);

        Permission::create(['name' => 'create-xapi'])->syncRoles([
            $roles['admin'],
        ]);

        Permission::create(['name' => 'edit-xapi'])->syncRoles([
            $roles['admin'],
        ]);

        Permission::create(['name' => 'delete-xapi'])->syncRoles([
            $roles['admin'],
        ]);

        Permission::create(['name' => 'export-xapi'])->syncRoles([
            $roles['admin'],
            $roles['payments'],
        ]);
    }

    /**
     * History
     */
    protected function createPermissionsForHistory(array $roles)
    {
        Permission::create(['name' => 'see-history'])->syncRoles([
            $roles['admin'],
        ]);
    }

    /**
     * Settings
     */
    protected function createPermissionsForSettings(array $roles)
    {
        Permission::create(['name' => 'edit-settings']);
    }
}
