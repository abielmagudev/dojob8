<?php

namespace App\Http\Controllers\WorkOrderController\Show;

use App\Http\Controllers\WorkOrderController\Kernel\ResponseConstructor;

class Timeline extends ResponseConstructor
{
    public function forData(): array
    {
        return [
            'show' => 'timeline',
        ];
    }
}
