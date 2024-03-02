<?php

namespace App\Models\Payment\Services;

use App\Models\Payment;
use App\Models\WorkOrder;

class WorkOrderPaymentFactory
{
    public static function create(WorkOrder $work_order)
    {
        return Payment::create([
            'status' => Payment::INITIAL_STATUS,
            'work_order_id' => $work_order->id,
        ]);
    }
}
