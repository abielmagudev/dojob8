<?php

namespace App\Http\Controllers\WorkOrderController\Show;

use App\Http\Controllers\WorkOrderController\Show\Data\CommentsLoader;
use App\Http\Controllers\WorkOrderController\Show\Data\HistoryLoader;
use App\Http\Controllers\WorkOrderController\Show\Data\InformationLoader;
use App\Http\Controllers\WorkOrderController\Show\Data\InspectionsLoader;
use App\Http\Controllers\WorkOrderController\Show\Data\MediaLoader;
use App\Http\Controllers\WorkOrderController\Show\Data\ReworksLoader;
use App\Http\Controllers\WorkOrderController\Show\Data\WarrantiesLoader;

class ShowDataLoadersContainer
{
    public static $loaders = [
        'comments' => CommentsLoader::class,
        'history' => HistoryLoader::class,
        'information' => InformationLoader::class,
        'inspections' => InspectionsLoader::class,
        'media' => MediaLoader::class,
        'reworks' => ReworksLoader::class,
        'warranties' => WarrantiesLoader::class,
    ];

    public static function all()
    {
        return collect( self::$loaders );
    }

    public static function has(string $loader)
    {
        return self::all()->has($loader);
    }

    public static function get(string $loader)
    {
        return self::all()->get($loader);
    }
}
