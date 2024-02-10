<?php 

namespace App\Models\WorkOrder\Associated;

use App\Models\WorkOrder;

trait HasWorkOrdersTrait
{
    // Attributes

    public function getWorkOrdersCounterAttribute()
    {
        return $this->work_orders_count ?? $this->work_orders->count();
    }

    public function getIncompleteWorkOrdersCounterAttribute()
    {
        return $this->incomplete_work_orders_count ?? $this->incomplete_work_orders->count();
    }


    // Validators

    public function hasWorkOrders()
    {
        return (bool) ($this->work_orders_count ?? $this->work_orders->count());
    }

    public function hasWorkOrdersWithIncompleteStatus()
    {
        return (bool) $this->onlyIncompleteWorkOrders()->count();
    }
    
    public function hasIncompleteWorkOrders()
    {
        return (bool) ($this->incomplete_work_orders_count ?? $this->incomplete_work_orders->count());
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
