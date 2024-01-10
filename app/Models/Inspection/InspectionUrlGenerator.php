<?php

namespace App\Models\Inspection;

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

    public static function onHold(array $parameters = [])
    {
        return route('inspections.index', array_merge($parameters, [
            'status_group' => ['on hold']
        ]));
    }

    public static function pendingOrOnHold(array $parameters = [])
    {
        return route('inspections.index', array_merge($parameters, [
            'status_group' => ['pending','on hold']
        ]));
    }
}
