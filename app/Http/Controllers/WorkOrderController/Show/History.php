<?php

namespace App\Http\Controllers\WorkOrderController\Show;

use App\Http\Controllers\WorkOrderController\Kernel\ResponseConstructor;
use App\Models\History as HistoryModel;

class History extends ResponseConstructor
{
    public function forData(): array
    {
        return [
            'show' => 'history',
            'history' => HistoryModel::with('user')->about($this->work_order)->paginate(35),
        ];
    }
}
