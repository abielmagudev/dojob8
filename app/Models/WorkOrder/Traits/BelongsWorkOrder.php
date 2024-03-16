<?php 

namespace App\Models\WorkOrder\Traits;

use App\Models\WorkOrder;

trait BelongsWorkOrder
{
    // Relationship
    
    public function work_order()
    {
        return $this->belongsTo(WorkOrder::class);
    }
}
