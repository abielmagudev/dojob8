<?php 

namespace App\Models\WorkOrder;

use App\Models\WorkOrder;

trait BelongWorkOrderTrait
{
    // Relationships
    
    public function work_order()
    {
        return $this->belongsTo(WorkOrder::class);
    }
}
