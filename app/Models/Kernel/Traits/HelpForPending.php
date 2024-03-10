<?php

namespace App\Models\Kernel\Traits;

use Illuminate\Support\Facades\DB;

trait HelpForPending
{
    public function scopeAsPendingCount($query)
    {
        $query->select( DB::raw('COUNT(*) as pending_count') );

        $query = $query->pending();

        return $query;
    }

    public function scopeAsNoPendingCount($query)
    {
        $query->select( DB::raw('COUNT(*) as no_pending_count') );

        $query = $query->noPending();

        return $query;
    }

    public function scopeFilterByPending($query, $value)
    {
        if(! in_array($value, [0, 1]) ) {
            return $query;
        }

        return $value == 0 ? $query->noPending() : $query->pending();
    }
}
