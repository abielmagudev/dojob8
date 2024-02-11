<?php 

namespace App\Models\WorkOrder\Associated;

use App\Models\WorkOrder;

trait HasWorkOrdersTrait
{
    // Attributes

    public function getWorkOrdersCounterAttribute()
    {
        return ($this->work_orders_count ?? $this->work_orders->count());
    }

    public function getWorkOrdersWithIncompleteStatusCounterAttribute()
    {
        return $this->onlyIncompleteWorkOrders()->count();
    }

    public function getIncompleteWorkOrdersCounterAttribute()
    {
        return ($this->incomplete_work_orders_count ?? $this->incomplete_work_orders->count());
    }


    // Validators

    public function hasWorkOrders()
    {
        return (bool) $this->work_orders_counter;
    }

    public function hasWorkOrdersWithIncompleteStatus()
    {
        return (bool) $this->work_orders_with_incomplete_status_counter;
    }
    
    public function hasIncompleteWorkOrders()
    {
        return (bool) $this->incomplete_work_orders_counter;
    }


    // Actions

    public function onlyIncompleteWorkOrders()
    {
        return $this->work_orders->filter(function ($wo) {
            return $wo->hasIncompleteStatus();
        });
    }

    public function onlyWorkOrdersForRectification()
    {
        return $this->work_orders->filter(function ($wo) {
            return $wo->isStandard() && $wo->isCompleted();
        });
    }


    // Relationships

    public function work_orders()
    {
        return $this->hasMany(WorkOrder::class);
    }

    public function incomplete_work_orders()
    {
        return $this->hasMany(WorkOrder::class)->whereIn('status', WorkOrder::getIncompleteStatuses()->toArray());
    }
}

/**
 * Una manera de verificar si una relación ha sido cargada en una colección de modelos después de realizar eager loading 
 * "isEagerLoaded" y "relationLoaded"
 * 
 * $collection->first()->isEagerLoaded('models')
 * $collection->relationLoaded('models');
 * $collection: $item->relationLoaded('models')
 */
