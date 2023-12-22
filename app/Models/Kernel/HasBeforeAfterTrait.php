<?php

namespace App\Models\Kernel;

trait HasBeforeAfterTrait
{
    public function before()
    {
        return self::beforeTo($this->id)->first();
    }

    public function after()
    {
        return self::afterTo($this->id)->first();
    }

    public function scopeBeforeTo($query, int $id)
    {
        return $query->where('id', '<', $id)->orderBy('id', 'desc');
    }

    public function scopeAfterTo($query, int $id)
    {
        return $query->where('id', '>', $id)->orderBy('id', 'asc');
    }
}
