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

    public function scopeAvailable($query)
    {
        return $query->where('is_available', 1);
    }

    public function scopeUnavailable($query)
    {
        return $query->where('is_available', 0);
    }

    public function scopeFilterByAvailable($query, $value)
    {
        return in_array($value, [0, 1]) ? $query->where('is_available', $value) : $query;
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

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeInactive($query)
    {
        return $query->where('is_active', 0);
    }

    public function scopeFilterByActive($query, $value)
    {
        return in_array($value, [0, 1]) ? $query->where('is_active', $value) : $query;
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
