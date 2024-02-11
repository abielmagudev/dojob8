<?php 

namespace App\Models\Kernel\Traits;

trait HasActiveStatus
{
    // Mutators

    public function setIsActiveAttribute($value)
    {
        $this->attributes['is_active'] = is_int($this->id) ? (int) !empty($value) : 1;
    }


    // Attributes

    public function getActiveStatusAttribute()
    {
        return $this->isActive() ? 'active' : 'inactive';
    }

    public function getActiveValueAttribute()
    {
        return $this->is_active;
    }


    // Validators

    public function isActive()
    {
        return (bool) $this->is_active;
    }

    public function isInactive()
    {
        return ! $this->isActive();
    }


    // Scopes

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeInactive($query)
    {
        return $query->where('is_active', 0);
    }

    public function scopeUpdateActive($query)
    {
        return $query->update(['is_active' => 1]);
    }

    public function scopeUpdateInactive($query)
    {
        return $query->update(['is_active' => 0]);
    }


    // Filters

    public function scopeFilterByActive($query, $value)
    {
        return in_array($value, [0, 1]) ? $query->where('is_active', $value) : $query;
    }


    // Actions

    public function saveActive()
    {
        return $this->fill(['is_active' => 1])->save();
    }

    public function saveInactive()
    {
        return $this->fill(['is_active' => 0])->save();
    }
}
