<?php

namespace App\Http\Controllers\WorkOrderController\Index\Data;

use App\Models\WorkOrder;
use Illuminate\Http\Request;

class ContractorUser
{
    public static function data(Request $request)
    {
        $work_orders = WorkOrder::withAllRelationships()
        ->paginate(35)
        ->appends( $request->query() );

        return [
            'request' => $request,
            'work_orders' => $work_orders,
        ];
    }
}
