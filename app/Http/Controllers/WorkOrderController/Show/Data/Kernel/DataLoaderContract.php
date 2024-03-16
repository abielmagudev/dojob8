<?php

namespace App\Http\Controllers\WorkOrderController\Show\Data\Kernel;

use App\Models\WorkOrder;

interface DataLoaderContract
{
    public function data(WorkOrder $work_order): array;
}
