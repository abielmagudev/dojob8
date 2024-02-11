<?php 

namespace App\Models\Kernel\Traits;

trait HasAvailableStatus
{
    // Mutators

    public function setIsAvailableAttribute($value)
    {
        $this->attributes['is_available'] = is_int($this->id) ? (int) !empty($value) : 1;
    }


    // Attributes

    public function getAvailableStatusAttribute()
    {
        return $this->isAvailable() ? 'available' : 'unavailable';
    }

    public function getAvailableValueAttribute()
    {
        return $this->is_available;
    }


    // Validators

    public function isAvailable()
    {
        return (bool) $this->is_available;
    }

    public function isUnavailable()
    {
        return ! $this->isAvailable();
    }


    // Scopes

    public function scopeAvailable($query)
    {
        return $query->where('is_available', 1);
    }

    public function scopeUnavailable($query)
    {
        return $query->where('is_available', 0);
    }

    public function scopeUpdateAvailable($query)
    {
        return $query->update(['is_available' => 1]);
    }

    public function scopeUpdateUnavailable($query)
    {
        return $query->update(['is_available' => 0]);
    }


    // Filters

    public function scopeFilterByAvailable($query, $value)
    {
        return in_array($value, [0, 1]) ? $query->where('is_available', $value) : $query;
    }


    // Actions

    public function saveAvailable()
    {
        return $this->fill(['is_available' => 1])->save();
    }

    public function saveUnavailable()
    {
        return $this->fill(['is_available' => 0])->save();
    }
}
