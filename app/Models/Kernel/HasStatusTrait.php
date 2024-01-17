<?php

namespace App\Models\Kernel;

use Illuminate\Http\Request;

trait HasStatusTrait
{
    // Validators

    public function isStatus(string $status)
    {
        return $this->status == $status;
    }


    // Scopes

    public function scopeWhereStatus($query, string $value)
    {
        return $query->where('status', $value);
    }

    public function scopeWhereInStatus($query, array $values)
    {
        return $query->whereIn('status', $values);
    }


    // Filters

    public function scopeFilterByStatus($query, $value)
    {
        return is_string($value) &&! empty($value) ? $query->whereStatus($value) : $query;
    }

    public function scopeFilterByStatusGroup($query, $status_group)
    {
        return is_array($status_group) &&! empty($status_group) ? $query->whereInStatus($status_group) : $query;
    }
}
