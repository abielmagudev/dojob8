<?php

namespace App\Http\Controllers\InspectionController;

use App\Models\Inspection;

class InspectionUrlGenerator
{
    public static function all(array $parameters = [])
    {
        return route('inspections.index', array_merge($parameters, [
            'dates' => 'any',
        ]));
    }

    public static function pending(array $parameters = [])
    {
        return route('inspections.index', array_merge($parameters, [
            'status_group' => ['pending'],
            'dates' => 'any',
        ]));
    }

    public static function awaiting(array $parameters = [])
    {
        return route('inspections.index', array_merge($parameters, [
            'status_group' => ['awaiting'],
            'dates' => 'any',
        ]));
    }

    public static function pendingAndAwaiting(array $parameters = [])
    {
        return route('inspections.index', array_merge($parameters, [
            'status_group' => ['pending', 'awaiting'],
            'dates' => 'any',
        ]));
    }
}
