<?php

namespace App\Models\User\Kernel;

use App\Models\User\Services\RoleCatalogService;

trait AssistRolesTrait
{
    // Role accessors

    public function getRoleNamesAttribute()
    {
        return $this->getRoleNames();
    }

    public function getPrimaryRoleNameAttribute()
    {
        return $this->getRoleNames()->first() ?? null;
    }


    // Role Validators

    public function hasAdminRole()
    {
        return RoleCatalogService::admin()->contains( $this->primary_role_name );
    }

    public function hasFieldRole()
    {
        return RoleCatalogService::field()->contains( $this->primary_role_name );
    }

    public function hasPartnerRole()
    {
        return RoleCatalogService::partner()->contains( $this->primary_role_name );
    }


    // Scopes

    public function scopeExcludesSuperAdminRole($query)
    {
        return $query->whereHas('roles', function ($q) {
            $q->where('name', '!=', 'SuperAdmin');
        });
    } 


    // Filters

    public function scopeFilterByRole($query, $value)
    {
        if( empty($value) ) {
            return $query;
        }

        return $query->whereHas('roles', function ($q) use ($value) {
            $q->where('name', $value);
        });
    }
}
