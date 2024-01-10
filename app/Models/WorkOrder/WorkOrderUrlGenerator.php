<?php

namespace App\Models\WorkOrder;

use App\Models\WorkOrder;

class WorkOrderUrlGenerator
{
    public static function all(array $parameters = [])
    {
        return route('work-orders.index', array_merge($parameters, [
            // ...
        ]));
    }

    public static function finished(array $parameters = [])
    {
        return route('work-orders.index', array_merge($parameters, [
            'status_group' => WorkOrder::getFinishedStatuses()->all(),
            'sort' => 'asc',
        ]));
    }

    public static function unfinished(array $parameters = [])
    {
        return route('work-orders.index', array_merge($parameters, [
            'status_group' => WorkOrder::getUnfinishedStatuses()->all(),
            'sort' => 'asc',
        ]));
    }
}
