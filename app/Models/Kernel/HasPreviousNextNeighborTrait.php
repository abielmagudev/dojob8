<?php

namespace App\Models\Kernel;

trait HasPreviousNextNeighborTrait
{
    public function previous()
    {
        return self::previousTo($this->id)->first();
    }

    public function next()
    {
        return self::nextTo($this->id)->first();
    }

    public function scopePreviousTo($query, int $id, int $limit = 1)
    {
        return $query->where('id', '<', $id)->orderBy('id', 'desc')->limit($limit);
    }

    public function scopeNextTo($query, int $id, int $limit = 1)
    {
        return $query->where('id', '>', $id)->orderBy('id', 'asc')->limit($limit);
    }
}
