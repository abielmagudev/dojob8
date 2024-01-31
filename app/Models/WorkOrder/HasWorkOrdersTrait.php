<?php 

namespace App\Models\WorkOrder;

use App\Models\WorkOrder;

trait HasWorkOrdersTrait
{
    // Attributes

    public function getIncompleteWorkOrdersCountAttribute()
    {
        return $this->incomplete_work_orders ? $this->incomplete_work_orders->count() : 0;
    }

    public function getWorkOrdersForReworkAttribute()
    {
        return $this->work_orders->filter(fn($wo) => $wo->qualifiesForRework() );
    }

    public function getWorkOrdersForWarrantyAttribute()
    {
        return $this->work_orders->filter(fn($wo) => $wo->qualifiesForWarranty() );
    }

    public function getWorkOrdersToBindAttribute()
    {
        return $this->work_orders->filter(fn($wo) => $wo->qualifiesForBind() );
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

    
    // Validators

    public function hasWorkOrders()
    {
        return (bool) $this->work_orders->count();
    }

    public function hasWorkOrdersForRework()
    {
        return (bool) $this->work_orders_for_rework->count();
    }
    public function hasWorkOrdersForWarranty()
    {
        return (bool) $this->work_orders_for_warranty->count();
    }

    public function hasWorkOrdersToBind()
    {
        return (bool) $this->work_orders_to_bind->count();
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

    public function incomplete_work_orders()
    {
        return $this->hasMany(WorkOrder::class)->whereIn('status', WorkOrder::getIncompleteStatuses()->toArray());
    }
}
