<?php

namespace App\Models\User;

trait HasRoleClassifier
{
    // Validators

    public function hasAdminRole(): bool
    {
        return UserRoleClassifier::collectionAdminRoles()->contains($this->role_name);
    }

    public function hasNonAdminRole(): bool
    {
        return UserRoleClassifier::collectionNonAdminRoles()->contains($this->role_name);
    }

    public function hasFieldRole(): bool
    {
        return UserRoleClassifier::collectionFieldRoles()->contains($this->role_name);
    }

    public function hasPartnerRole(): bool
    {
        return UserRoleClassifier::collectionPartnerRoles()->contains($this->role_name);
    }
}
