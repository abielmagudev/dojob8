<?php 

namespace App\Models\WorkOrder;

use App\Models\WorkOrder;

trait HasWorkOrdersTrait
{
    // Attributes

    public function getIncompleteWorkOrdersAttribute()
    {
        return $this->work_orders->filter(function ($work_order) {
            return WorkOrder::inIncompleteStatuses($work_order->status);
        });
    }

    public function getIncompleteWorkOrdersCountAttribute()
    {
        return $this->incomplete_work_orders ? $this->incomplete_work_orders->count() : 0;
    }

    // public function getIncompleteWorkOrdersUrlAttribute()
    // {
    //     return $this->getUrlUnfinishedWorkOrders();
    // }

    // public function getUrlOwnWorkOrdersAttribute()
    // {
    //     return $this->getUrlOwnWorkOrders();
    // }



    // Actions

    public function getWorkOrdersWith(array $relations)
    {
        return $this->work_orders->load($relations);
    }

    public function getWorkOrdersByStatus(string $value)
    {
        return $this->work_orders->filter(fn($work_order) => $work_order->status == $value);
    }

    

    // Validators

    public function hasWorkOrders()
    {
        return (bool) $this->work_orders->count();
    }

    public function hasIncompleteWorkOrders()
    {
        return (bool) $this->incomplete_work_orders_count;
    }


    // Relationships

    public function work_orders()
    {
        return $this->hasMany(WorkOrder::class);
    }
}
