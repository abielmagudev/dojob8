<?php

namespace App\Http\Controllers\WorkOrderController\Show;

use App\Http\Controllers\WorkOrderController\Kernel\ResponseConstructor;

class Comments extends ResponseConstructor
{
    public function forData(): array
    {
        $this->work_order->load(['comments.user.profile']);

        return [
            'show' => 'comments',
            'comments' => $this->work_order->comments->sortByDesc('id'),
        ];
    }
}
