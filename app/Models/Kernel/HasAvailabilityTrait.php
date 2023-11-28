<?php

namespace App\Models\Kernel;

trait HasAvailabilityTrait
{
    // Available

    public function getAvailableStatusAttribute()
    {
        return $this->isAvailable() ? 'available' : 'not available';
    }

    public function isAvailable()
    {
        return (bool) $this->is_available;
    }

    public function isNotAvailable()
    {
        return ! $this->isAvailable();
    }

    public function scopeAvailable($query)
    {
        return $query->where('is_available', 1);
    }

    public function scopeNotAvailable($query)
    {
        return $query->where('is_available', 0);
    }

    public function indispose()
    {
        return $this->fill(['is_available' => 0])->save();
    }


    // Active

    public function getActiveStatusAttribute()
    {
        return $this->isActive() ? 'active' : 'inactive';
    }

    public function isActive()
    {
        return (bool) $this->is_active;
    }

    public function isInactive()
    {
        return ! $this->isActive();
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeInactive($query)
    {
        return $query->where('is_active', 0);
    }

    public function deactivate()
    {
        return $this->fill(['is_active' => 0])->save();
    }
}
