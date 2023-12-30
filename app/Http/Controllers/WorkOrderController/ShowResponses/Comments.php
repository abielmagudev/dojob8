<?php

namespace App\Http\Controllers\WorkOrderController\ShowResponses;

use App\Http\Controllers\WorkOrderController\ShowResponses\Kernel\ShowResponseBase;

class Comments extends ShowResponseBase
{
    public function forData(): array
    {
        return [
            'show' => 'comments',
        ];
    }
}
