<?php 

namespace App\Models\Inspection\Associated;

use App\Models\Inspection;

trait HasInspectionsTrait
{
    // Accessors

    public function getInspectionsCounterAttribute()
    {
        return $this->inspections_count ?? $this->inspections->count();
    }

    public function getInspectionsWithAwaitingStatusCounterAttribute()
    {
        return $this->onlyAwaitingInspections()->count();
    }

    public function getPendingInspectionsCounterAttribute()
    {
        return ($this->pending_inspections_count ?? $this->pending_inspections->count());
    }

    public function getAwaitingInspectionsCounterAttribute()
    {
        return ($this->awaiting_inspections_count ?? $this->awaiting_inspections->count());
    }


    // Validators

    public function hasInspections(): bool
    {
        return (bool) $this->inspections_counter;
    }

    public function hasInspectionsWithPendingStatus()
    {
        return (bool) $this->inspections_with_pending_status_counter;
    }

    public function hasInspectionsWithAwaitingStatus()
    {
        return (bool) $this->inspections_with_awaiting_status_counter;
    }

    public function hasPendingInspections(): bool
    {
        return (bool) $this->pending_inspections_counter;
    }

    public function hasAwaitingInspections(): bool
    {
        return (bool) $this->awaiting_inspections_counter;
    }


    // Actions

    public function onlyPendingInspections()
    {
        return $this->inspections->filter(fn($i) => $i->isPending());
    }

    public function onlyAwaitingInspections()
    {
        return $this->inspections->filter(fn($i) => $i->isAwaiting());
    }


    // Relationships

    public function inspections()
    {
        return $this->hasMany(Inspection::class);
    }

    public function pending_inspections()
    {
        return $this->hasMany(Inspection::class)->where('status', 'pending');
    }

    public function awaiting_inspections()
    {
        return $this->hasMany(Inspection::class)->where('status', 'awaiting');
    }
}
