<?php

namespace App\Models\Kernel\Traits;

use Illuminate\Support\Facades\DB;

trait PendingContractImplemented
{
    public function hasPendingAttribute(string $attribute): bool
    {
        return is_null($this->$attribute);
    }

    public function hasNoPendingAttribute(string $attribute): bool
    {
        return ! $this->hasPendingAttribute($attribute);
    }

    public function scopeAsPendingCount($query)
    {
        $query->select( DB::raw('COUNT(*) as pending_count') );

        return $query->pending();
    }

    public function scopeAsNoPendingCount($query)
    {
        $query->select( DB::raw('COUNT(*) as no_pending_count') );

        return $query->noPending();
    }

    public function scopeFilterByPending($query, $value)
    {
        if(! in_array($value, [0, 1]) ) {
            return $query;
        }

        return $value == 0 ? $query->noPending() : $query->pending();
    }
}
