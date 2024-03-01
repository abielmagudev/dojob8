<?php

namespace App\Models\WorkOrder\Traits;

use App\Models\Contractor;
use App\Models\Crew;

trait Validators
{
    public function hasContractor()
    {
        return ! is_null($this->contractor_id);
    }

    public function hasContractorVerified()
    {
        return ! is_null($this->contractor_id) && is_a($this->contractor, Contractor::class);
    }

    public function hasCrew()
    {
        return ! is_null($this->crew_id);
    }

    public function hasCrewVerified()
    {
        return ! is_null($this->crew_id) && is_a($this->crew, Crew::class);
    }

    public function hasPending()
    {
        return is_null($this->scheduled_date) || is_null($this->crew_id);
    }

    public function hasIncompleteStatus()
    {
        return self::collectionIncompleteStatuses()->contains($this->status);
    }

    public function hasWorkingAt()
    {
        return ! empty( $this->working_at );
    }

    public function hasDoneAt()
    {
        return ! empty( $this->done_at );
    }

    public function hasCompletedAt()
    {
        return ! empty( $this->completed_at );
    }
    
    public function isCompleted()
    {
        return $this->status == 'completed' && $this->hasCompletedAt();
    }

    public function isRework()
    {
        return is_int($this->rework_id);
    }

    public function isWarranty()
    {
        return is_int($this->warranty_id);
    }

    public function isStandard()
    {
        return ! $this->isRework() && ! $this->isWarranty();
    }

    public function isNonstandard()
    {
        return $this->isRework() || $this->isWarranty();
    }

    public function qualifiesForRectification()
    {
        return $this->isStandard() && $this->isCompleted();
    }

    public function qualifiesForInspection()
    {
        return $this->isCompleted();
    }
}
