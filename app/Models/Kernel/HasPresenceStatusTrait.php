<?php

namespace App\Models\Kernel;

trait HasPresenceStatusTrait
{
    public function getPresenceStatusAttribute()
    {
        if(! is_null($this->is_available) ) {
            return $this->isAvailable() ? 'available' : 'unavailable';
        }

        if(! is_null($this->is_active) ) {
            return $this->isActive() ? 'active' : 'inactive';
        }

        return;
    }


    // Available

    public function isAvailable()
    {
        return (bool) $this->is_available;
    }

    public function isUnavailable()
    {
        return ! $this->isAvailable();
    }

    public function scopeWhereAvailable($query, $value)
    {
        return $query->where('is_available', $value);
    }

    public function scopeAvailable($query)
    {
        return $query->where('is_available', 1);
    }

    public function scopeUnavailable($query)
    {
        return $query->where('is_available', 0);
    }

    public function available()
    {
        return $this->fill(['is_available' => 1])->save();
    }

    public function unavailable()
    {
        return $this->fill(['is_available' => 0])->save();
    }


    // Active

    public function isActive()
    {
        return (bool) $this->is_active;
    }

    public function isInactive()
    {
        return ! $this->isActive();
    }

    public function scopeWhereActive($query, $value)
    {
        return $query->where('is_active', $value);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeInactive($query)
    {
        return $query->where('is_active', 0);
    }

    public function activate()
    {
        return $this->fill(['is_active' => 1])->save();
    }

    public function deactivate()
    {
        return $this->fill(['is_active' => 0])->save();
    }
}
