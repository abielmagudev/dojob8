<?php

namespace App\Models\Contractor\Traits;

use App\Models\Contractor;

trait BelongsContractor
{
    // Relationship

    public function contractor()
    {
        return $this->belongsTo(Contractor::class)->withTrashed();
    }


    // Validators

    public function hasContractor()
    {
        return ! empty( $this->contractor_id );
    }

    public function existsContractor()
    {
        return $this->hasContractor() && is_a($this->contractor, Contractor::class);
    }


    // Scopes

    public function scopeFilterByContractor($query, $value)
    {
        if( is_null($value) ||! ctype_digit($value) ) {
            return $query;
        }

        if( $value == 0 ) {
            return $query->whereNull('contractor_id');
        }

        return $query->where('contractor_id', $value);
    }
}
