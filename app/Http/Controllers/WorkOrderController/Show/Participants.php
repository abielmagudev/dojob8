<?php

namespace App\Http\Controllers\WorkOrderController\Show;

use App\Http\Controllers\WorkOrderController\Kernel\ResponseConstructor;

class Participants extends ResponseConstructor
{
    public function forData(): array
    {
        return [
            'show' => 'participants',
        ];
    }
}
