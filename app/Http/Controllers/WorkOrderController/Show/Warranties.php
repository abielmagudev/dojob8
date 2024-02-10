<?php

namespace App\Http\Controllers\WorkOrderController\Show;

use App\Http\Controllers\WorkOrderController\Kernel\ResponseConstructor;

class Warranties extends ResponseConstructor
{
    public function forData(): array
    {
        return [
            'show' => $this->work_order->isStandard() ? 'warranties' : 'information',
        ];
    }
}
