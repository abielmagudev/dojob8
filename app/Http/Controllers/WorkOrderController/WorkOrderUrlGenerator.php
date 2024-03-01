<?php

namespace App\Http\Controllers\WorkOrderController;

use App\Models\WorkOrder;

class WorkOrderUrlGenerator
{
    public static function all(array $parameters = [])
    {
        return route('work-orders.index', array_merge($parameters, [
            'dates' => 'any',
        ]));
    }

    public static function pending(array $parameters = [])
    {
        return route('work-orders.index', array_merge($parameters, [
            'pending' => 1,
            'sort' => 'asc',
            'dates' => 'any',
        ]));
    }

    public static function incomplete(array $parameters = [])
    {
        return route('work-orders.index', array_merge($parameters, [
            'status_group' => WorkOrder::collectionIncompleteStatuses()->toArray(),
            'sort' => 'asc',
            'dates' => 'any',
        ]));
    }

    public static function closed(array $parameters = [])
    {
        return route('work-orders.index', array_merge($parameters, [
            'status_group' => WorkOrder::getClosedStatuses()->all(),
            'sort' => 'asc',
            'dates' => 'any',
        ]));
    }
}
