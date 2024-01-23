<?php

namespace App\Http\Controllers\WorkOrderController\Show;

use App\Http\Controllers\WorkOrderController\Kernel\ResponseConstructor;

class History extends ResponseConstructor
{
    public function forData(): array
    {
        return [
            'show' => 'history',
        ];
    }
}
