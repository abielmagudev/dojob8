<?php 

namespace App\Models\WorkOrder\Traits;

use Carbon\Carbon;
trait Attributes
{    
    public function getWorkingDateInputAttribute()
    {
        return ! is_null($this->working_at) ? Carbon::parse($this->working_at)->format('Y-m-d') : null;
    }

    public function getWorkingTimeInputAttribute()
    {
        return ! is_null($this->working_at) ? Carbon::parse($this->working_at)->format('H:i') : null;
    }

    public function getDoneDateInputAttribute()
    {
        return ! is_null($this->done_at) ? Carbon::parse($this->done_at)->format('Y-m-d') : null;
    }

    public function getDoneTimeInputAttribute()
    {
        return ! is_null($this->done_at) ? Carbon::parse($this->done_at)->format('H:i') : null;
    }

    public function getCompletedDateHumanAttribute()
    {
        return ! is_null($this->completed_at) ? Carbon::parse($this->completed_at)->format('D d M, Y') : null;
    }

    public function getCompletedTimeHumanAttribute()
    {
        return ! is_null($this->completed_at) ? Carbon::parse($this->completed_at)->format('g:i A') : null;
    }

    public function getTypeAttribute()
    {
        if( $this->isRework() ) {
            return 'rework';
        }

        if( $this->isWarranty() ) {
            return 'warranty';
        }

        return 'standard';
    }
}
