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

    public function hasContractorChecked()
    {
        return $this->hasContractor() && is_a($this->contractor, Contractor::class);
    }



    // Scopes

    public function scopeFilterByContractor($query, $value)
    {
        if( empty($value) ) {
            return $query; 
        }

        return $query->where('contractor_id', $value);
    }
}
