<?php

namespace App\Models\Crew\Traits;

use App\Models\Crew;

trait HasCrew
{
    // Validators

    public function hasCrew()
    {
        return ! empty($this->crew_id);
    }

    public function hasCrewChecked()
    {
        return ! empty($this->crew_id) && is_a($this->crew, Crew::class);
    }


    // Filters

    public function scopeFilterByCrew($query, $value)
    {
        if( is_null($value) ) {
            return $query;
        }
        
        return $query->where('crew_id', $value);
    }


    // Relationships

    public function crew()
    {
        return $this->belongsTo(Crew::class)->withTrashed();
    }
}
