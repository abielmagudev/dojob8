<?php 

namespace App\Http\Controllers\WorkOrderController\ShowActionResponses\Kernel;

use App\Models\WorkOrder;

class ShowActionResponseBase
{
    protected $work_order;

    public function __construct(WorkOrder $work_order)
    {
        $this->work_order = $work_order;
    }
}
