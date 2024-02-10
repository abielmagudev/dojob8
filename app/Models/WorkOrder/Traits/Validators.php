<?php

namespace App\Models\WorkOrder\Traits;

trait Validators
{
    public function hasContractor()
    {
        return is_int($this->contractor_id);
    }

    public function hasIncompleteStatus()
    {
        return self::inIncompleteStatuses($this->status);
    }
    
    public function isCompleted()
    {
        return $this->status == 'completed';
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
}
