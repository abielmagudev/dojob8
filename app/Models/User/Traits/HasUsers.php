<?php

namespace App\Models\User\Traits;

use App\Models\User;
use App\Models\User\Kernel\ProfileContainer;

trait HasUsers
{
    // Accessors

    public function getProfileShortAttribute(): string 
    {
        return ProfileContainer::getShort( get_class($this) );
    }

    
    // Relationships

    public function users()
    {
        return $this->morphMany(User::class, 'profile');
    }
}
