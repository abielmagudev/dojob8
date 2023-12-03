<?php 

namespace App\Models\WorkOrder;

use App\Models\WorkOrder;

trait HasWorkOrdersTrait
{
    // Attributes

    public function getWorkOrdersUnfinishedAttribute()
    {
        return $this->work_orders->filter(function ($work_order) {
            return in_array($work_order->status, WorkOrder::getUnfinishedStatuses()->all());
        });
    }

    public function getWorkOrdersUnfinishedCountAttribute()
    {
        return $this->work_orders_unfinished ? $this->work_orders_unfinished->count() : 0;
    }



    // Actions

    public function getWorkOrdersWith(array $relations)
    {
        return $this->work_orders->load($relations);
    }

    public function getWorkOrdersByStatus(string $value)
    {
        return $this->work_orders->filter(fn($work_order) => $work_order->status == $value);
    }

    public function getUrlUnfinishedWorkOrders(string $suffix = '')
    {
        $model = strtolower( class_basename( __CLASS__ ) . $suffix );

        return WorkOrder::generateUrlUnfinishedStatus([
            $model => $this->id,
        ]);
    }

    
    // Validators

    public function hasWorkOrders()
    {
        return (bool) $this->work_orders->count();
    }

    public function hasUnfinishedWorkOrders()
    {
        return (bool) $this->work_orders_unfinished_count;
    }



    // Relationships

    public function work_orders()
    {
        return $this->hasMany(WorkOrder::class);
    }

    public function work_order()
    {
        return $this->belongsTo(WorkOrder::class);
    }
}
