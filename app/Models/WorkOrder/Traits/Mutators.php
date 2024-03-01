<?php

namespace App\Models\WorkOrder\Traits;

trait Mutators
{
    public function setWorkingAtAttribute($values)
    {
        if( is_array($values) ) {
            $values = trim( implode(' ', $values) );
        }

        if(! empty($values) && $values <> $this->working_at ) {
            $this->attributes['working_at'] = $values;
            $this->attributes['working_by'] = auth()->id();
        }
        
        if( empty($values) ) {
            $this->attributes['working_at'] = null;
            $this->attributes['working_by'] = null;
        }
    }

    public function setDoneAtAttribute($values)
    {
        if( is_array($values) ) {
            $values = trim( implode(' ', $values) );
        }

        if(! empty($values) && $values <> $this->done_at ) {
            $this->attributes['done_at'] = $values;
            $this->attributes['done_by'] = auth()->id();
        }
        
        if( empty($values) ) {
            $this->attributes['done_at'] = null;
            $this->attributes['done_by'] = null;
        }
    }

    public function setCompletedAtAttribute($status)
    {        
        if( $status == 'completed' && is_null($this->completed_at) ) {
            $this->attributes['completed_at'] = now();
            $this->attributes['completed_by'] = auth()->id();
        }
    }
}
