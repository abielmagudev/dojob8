<?php 

namespace App\Models\Inspection\Traits;

use App\Models\Inspection;

trait HasInspections
{
    // Accessors

    public function getInspectionsCounterAttribute()
    {
        return ($this->inspections_count ?? $this->inspections->count());
    }


    // Relationships

    public function inspections()
    {
        return $this->hasMany(Inspection::class);
    }


    // Validators

    public function hasInspections()
    {
        return (bool) $this->inspections_counter;
    }


    // Actions

    public function onlyPendingInspections()
    {
        return $this->inspections->filter(fn($i) => $i->hasPendingAttributes());
    }

    public function onlyAwaitingInspections()
    {
        return $this->inspections->filter(fn($i) => $i->isAwaiting());
    }
}
