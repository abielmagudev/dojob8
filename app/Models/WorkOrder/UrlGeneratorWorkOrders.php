<?php

namespace App\Models\WorkOrder;

use App\Models\WorkOrder;

class UrlGeneratorWorkOrders
{
    public static function all(array $parameters = [])
    {
        return route('work-orders.index', array_merge($parameters, [
            // ...
        ]));
    }

    public static function completed(array $parameters = [])
    {
        return route('work-orders.index', array_merge($parameters, [
            'status_group' => WorkOrder::getCompletedStatuses()->all(),
            'sort' => 'asc',
            'fltr' => 'on',
        ]));
    }

    public static function incomplete(array $parameters = [])
    {
        return route('work-orders.index', array_merge($parameters, [
            'status_group' => WorkOrder::getIncompleteStatuses()->all(),
            'sort' => 'asc',
            'fltr' => 'on',
        ]));
    }
}
