<?php

namespace App\Models\Kernel;

trait HasPreviousNextTrait
{
    public function scopeWherePrevious($query, int $id, int $limit = 1)
    {
        return $query->where('id', '<', $id)->orderBy('id', 'desc')->limit($limit);
    }

    public function scopeWhereNext($query, int $id, int $limit = 1)
    {
        return $query->where('id', '>', $id)->orderBy('id', 'asc')->limit($limit);
    }
}
