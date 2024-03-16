<?php

namespace App\Http\Controllers\WorkOrderController\Services;

use App\Models\WorkOrder\Kernel\WorkOrderStatusCatalog;

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
            'status_group' => WorkOrderStatusCatalog::incomplete()->toArray(),
            'sort' => 'asc',
            'dates' => 'any',
        ]));
    }

    public static function closed(array $parameters = [])
    {
        return route('work-orders.index', array_merge($parameters, [
            'status_group' => WorkOrderStatusCatalog::closed()->toArray(),
            'sort' => 'asc',
            'dates' => 'any',
        ]));
    }
}
