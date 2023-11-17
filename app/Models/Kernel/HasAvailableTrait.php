<?php

namespace App\Models\Kernel;

trait HasAvailableTrait
{
    public function isAvailable()
    {
        return (bool) $this->is_available;
    }

    public function scopeAvailable($query)
    {
        return $query->where('is_available', 1);
    }
}
