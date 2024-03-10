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

    public function getUsersCounterAttribute()
    {
        return ($this->users_count ?? $this->users->count());
    }

    
    // Relationships

    public function users()
    {
        return $this->morphMany(User::class, 'profile');
    }


    // Validators

    public function hasUsers()
    {
        return (bool) $this->users_counter; 
    }
}
