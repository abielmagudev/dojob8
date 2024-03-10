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

    public function getInspectionsWithPendingAttributesCounterAttribute()
    {
        return $this->onlyPendingInspections()->count();
    }

    public function getInspectionsWithAwaitingStatusCounterAttribute()
    {
        return $this->onlyAwaitingInspections()->count();
    }

    public function getAwaitingInspectionsCounterAttribute()
    {
        return ($this->awaiting_inspections_count ?? $this->awaiting_inspections->count());
    }


    // Relationships

    public function inspections()
    {
        return $this->hasMany(Inspection::class);
    }

    public function awaiting_inspections()
    {
        return $this->hasMany(Inspection::class)->where('status', 'awaiting');
    }


    // Validators

    public function hasInspections()
    {
        return (bool) $this->inspections_counter;
    }

    public function hasAwaitingInspections()
    {
        return (bool) $this->awaiting_inspections_counter;
    }

    public function hasInspectionsWithPendingAttributes()
    {
        return (bool) $this->onlyPendingInspections()->count();
    }

    public function hasInspectionsWithAwaitingStatus()
    {
        return (bool) $this->onlyAwaitingInspections()->count();
    }


    // Actions

    public function onlyPendingInspections()
    {
        return $this->inspections->filter(fn($i) => $i->hasPending());
    }

    public function onlyAwaitingInspections()
    {
        return $this->inspections->filter(fn($i) => $i->isAwaiting() &&! $i->hasPending());
    }
}
