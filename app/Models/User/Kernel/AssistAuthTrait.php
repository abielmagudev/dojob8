<?php

namespace App\Models\User\Kernel;

trait AssistAuthTrait
{
    public function scopeExcludesAuth($query)
    {
        return $query->where('id', '!=', auth()->id());
    }
}
