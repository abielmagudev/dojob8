<?php 

namespace App\Models\WorkOrder\Traits;

use App\Models\WorkOrder;

trait BelongsWorkOrders
{
    // Relationship

    public function work_orders()
    {
        return $this->belongsToMany(WorkOrder::class);
    }


    // Scopes

    public function scopeWorkOrdersScheduled($query, $value)
    {
        return $query->whereHas('work_order', function($q) use ($value) {
            return $q->where('scheduled_date', $value);
        });
    }

    public function scopeWorkOrdersScheduledFrom($query, $value)
    {
        return $query->whereHas('work_order', function ($q) use ($value) {
            return $q->where('scheduled_date', '>=', $value);
        });
    }

    public function scopeWorkOrdersScheduledUntil($query, $value)
    {
        return $query->whereHas('work_order', function ($q) use ($value) {
            return $q->where('scheduled_date', '<=', $value);
        });
    }

    public function scopeWorkOrdersScheduledBetween($query, $values)
    {
        return $query->whereHas('work_order', function ($q) use ($values) {
            return $q->whereBetween('scheduled_date', $values);
        });
    }

    
    // Filters

    public function scopeFilterByWorkOrderDates($query, $values)
    {
        if(! isset($values['from']) &&! isset($values['to']) ) {
            return $query;
        }

        if( isset($values['from']) &&! isset($values['to']) ) {
            return $query->workOrdersScheduledFrom($values['from']);
        }
        
        if(! isset($values['from']) && isset($values['to']) ) {
            return $query->workOrdersScheduledUntil($values['to']);
        }

        return $query->workOrdersScheduledBetween($values);
    }

    public function scopeFilterByWorkOrderScheduled($query, $value)
    {
        if( empty($value) ) {
            return $query;
        }

        return $query->workOrdersScheduled($value);
    }
}
