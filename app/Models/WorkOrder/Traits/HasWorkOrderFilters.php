<?php 

namespace App\Models\WorkOrder\Traits;

trait HasWorkOrderFilters
{
    public function scopeFilterByWorkOrderDates($query, $values)
    {
        if(! isset($values['from']) &&! isset($values['to']) ) {
            return $query;
        }

        if( isset($values['from']) &&! isset($values['to']) )
        {
            return $query->whereHas('work_order', function ($query) use ($values) {
                return $query->where('scheduled_date', '>=', $values['from']);
            });
        }
        
        if(! isset($values['from']) && isset($values['to']) )
        {
            return $query->whereHas('work_order', function ($query) use ($values) {
                return $query->where('scheduled_date', '<=', $values['to']);
            });
        }

        return $query->whereHas('work_order', function ($query) use ($values) {
            return $query->whereBetween('scheduled_date', $values);
        });
    }

    public function scopeFilterByWorkOrderScheduledDate($query, $value)
    {
        return $query->whereHas('work_order', function($query) use ($value) {
            return $query->where('scheduled_date', $value);
        });
    }
}
