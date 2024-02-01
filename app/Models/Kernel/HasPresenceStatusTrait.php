<?php

namespace App\Models\Kernel;

trait HasPresenceStatusTrait
{
    public function getPresenceStatusAttribute()
    {
        if( isset($this->is_available) ) {
            return $this->isAvailable() ? 'available' : 'unavailable';
        }

        if( isset($this->is_active) ) {
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
        return $query->whereAvailable(1);
    }

    public function scopeUnavailable($query)
    {
        return $query->whereAvailable(0);
    }

    public function scopeUpdateAvailable($query)
    {
        return $query->update(['is_available' => 1]);
    }

    public function scopeUpdateUnavailable($query)
    {
        return $query->update(['is_available' => 0]);
    }

    public function setAvailable()
    {
        return $this->fill(['is_available' => 1])->save();
    }

    public function setUnavailable()
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

    public function scopeActiveIs($query, $value)
    {
        return $query->where('is_active', $value);
    }

    public function scopeActive($query)
    {
        return $query->activeIs(1);
    }

    public function scopeInactive($query)
    {
        return $query->activeIs(0);
    }

    public function scopeUpdateActive($query)
    {
        return $query->update(['is_active' => 1]);
    }

    public function scopeUpdateInactive($query)
    {
        return $query->update(['is_active' => 0]);
    }

    public function setActive()
    {
        return $this->fill(['is_active' => 1])->save();
    }

    public function setInactive()
    {
        return $this->fill(['is_active' => 0])->save();
    }
}
