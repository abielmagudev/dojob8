<?php 

namespace App\Models\WorkOrder\Traits;

use App\Models\WorkOrder;
use App\Models\WorkOrder\Kernel\WorkOrderStatusCatalog;
use App\Models\WorkOrder\Kernel\WorkOrderTypeCatalog;

trait HasWorkOrders
{
    // Relationships

    public function work_orders()
    {
        return $this->hasMany(WorkOrder::class);
    }

    public function incomplete_work_orders()
    {
        return $this->work_orders()->whereIn('status', WorkOrderStatusCatalog::incomplete()->toArray());
    }

    public function work_orders_to_rectify()
    {
        return $this->work_orders()->where('type', 'standard')->where('status', 'completed')->whereNull('rectification_id');
    }


    // Accessors

    public function getWorkOrdersCounterAttribute()
    {
        return ($this->work_orders_count ?? $this->work_orders->count());
    }

    public function getIncompleteWorkOrdersCounterAttribute()
    {
        return ($this->incomplete_work_orders_count ?? $this->incomplete_work_orders->count());
    }

    public function getWorkOrdersToRectifyCounterAttribute()
    {
        return ($this->work_orders_to_rectify_count ?? $this->work_orders_to_rectify->count());
    }


    // Validators

    public function hasWorkOrders()
    {
        return (bool) $this->work_orders_counter;
    }

    public function hasIncompleteWorkOrders()
    {
        return (bool) $this->incomplete_work_orders_counter;
    }

    public function hasWorkOrdersToRectify()
    {
        return (bool) $this->work_orders_to_rectify_counter;
    }
}

/**
 * Una manera de verificar si una relación ha sido cargada en una 
 * colección de modelos después de realizar eager loading...
 * 
 * "isEagerLoaded" y "relationLoaded"
 * 
 * $collection->first()->isEagerLoaded('models')
 * $collection->relationLoaded('models');
 * $collection: $item->relationLoaded('models')
 */
