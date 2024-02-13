<?php

namespace App\Models\WorkOrder\Traits;

trait Mutators
{
    public function setWorkingAtAttribute($values)
    {
        if( is_array($values) && empty( array_filter($values) ) || empty($values) ) {
            $values = null;
        }

        $this->attributes['working_at'] = is_array($values) ? implode(' ', $values) : $values;
    }

    public function setDoneAtAttribute($values)
    {
        if( is_array($values) && empty( array_filter($values) ) || empty($values) ) {
            $values = null;
        }

        $this->attributes['done_at'] = is_array($values) ? implode(' ', $values) : $values;
    }

    public function setCompletedAtAttribute($status)
    {        
        if( $status == 'completed' && is_null($this->completed_at) ) {
            $this->attributes['completed_at'] = now();
        }
    }
}
