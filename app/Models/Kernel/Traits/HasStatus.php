<?php

namespace App\Models\Kernel\Traits;

trait HasStatus
{
    // Validators

    public function hasStatus(bool $strict = false)
    {
        if( $strict ) { 
            return ! empty($this->status);
        }

        return isset($this->status) && $this->status !== '';
    }

    public function isStatus(string $status)
    {
        return $this->status == $status;
    }


    // Scopes

    public function scopeStatusIs($query, string $value)
    {
        return $query->where('status', $value);
    }

    public function scopeStatusIn($query, array $values)
    {
        return $query->whereIn('status', $values);
    }

    public function scopeStatusNotIn($query, array $values)
    {
        return $query->whereNotIn('status', $values);
    }


    // Filters

    public function scopeFilterByStatus($query, $value)
    {
        return is_string($value) &&! empty($value) ? $query->statusIs($value) : $query;
    }

    public function scopeFilterByStatusGroup($query, $status_group)
    {
        return is_array($status_group) &&! empty($status_group) ? $query->statusIn($status_group) : $query;
    }
}
