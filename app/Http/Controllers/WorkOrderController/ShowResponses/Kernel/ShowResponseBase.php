<?php 

namespace App\Http\Controllers\WorkOrderController\ShowResponses\Kernel;

use App\Models\WorkOrder;

abstract class ShowResponseBase
{
    protected $work_order;

    public function __construct(WorkOrder $work_order)
    {
        $this->work_order = $work_order;
    }

    public function data(array $extra = []): array
    {
        return array_merge($this->forData(), $extra);
    }

    abstract public function forData(): array;
}
