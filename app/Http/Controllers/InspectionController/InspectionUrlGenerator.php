<?php

namespace App\Http\Controllers\InspectionController;

use App\Models\Inspection;

class InspectionUrlGenerator
{
    public static function all(array $parameters = [])
    {
        return route('inspections.index', array_merge($parameters, [
            // ...
        ]));
    }

    public static function pending(array $parameters = [])
    {
        return route('inspections.index', array_merge($parameters, [
            'status_group' => ['pending']
        ]));
    }

    public static function awaiting(array $parameters = [])
    {
        return route('inspections.index', array_merge($parameters, [
            'status_group' => ['awaiting']
        ]));
    }

    public static function pendingAndAwaiting(array $parameters = [])
    {
        return route('inspections.index', array_merge($parameters, [
            'status_group' => ['pending', 'awaiting']
        ]));
    }
}
