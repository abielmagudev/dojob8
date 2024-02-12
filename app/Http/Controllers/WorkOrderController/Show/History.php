<?php

namespace App\Http\Controllers\WorkOrderController\Show;

use App\Http\Controllers\WorkOrderController\Kernel\ResponseConstructor;

class History extends ResponseConstructor
{
    public function forData(): array
    {
        $this->work_order->load('history.user');

        return [
            'show' => 'history',
            'history' => $this->work_order->history->sortByDesc('id'),
        ];
    }
}
