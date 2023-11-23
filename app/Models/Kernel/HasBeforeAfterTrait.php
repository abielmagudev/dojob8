<?php

namespace App\Models\Kernel;

trait HasBeforeAfterTrait
{
    public function scopeBefore($query, int $id, int $limit = 1)
    {
        return $query->where('id', '<', $id)->orderBy('id', 'desc')->limit($limit);
    }

    public function scopeAfter($query, int $id, int $limit = 1)
    {
        return $query->where('id', '>', $id)->orderBy('id', 'asc')->limit($limit);
    }
}
