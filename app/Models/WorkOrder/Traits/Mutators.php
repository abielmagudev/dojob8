<?php

namespace App\Models\WorkOrder\Traits;

trait Mutators
{
    public function setWorkingAtAttribute($value)
    {
        $this->attributes['working_at'] = ! empty($value) ? $value : null;
    }

    public function setDoneAtAttribute($value)
    {
        $this->attributes['done_at'] = ! empty($value) ? $value : null;
    }

    public function setCompletedAtAttribute($status)
    {        
        if( $status == 'completed' && is_null($this->completed_at) ) {
            $this->attributes['completed_at'] = now();
        }
    }
}
