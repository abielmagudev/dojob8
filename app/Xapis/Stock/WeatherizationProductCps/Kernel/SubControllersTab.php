<?php 

namespace App\Xapis\Stock\WeatherizationMeasureCps\Kernel;

use App\Xapis\Stock\WeatherizationProductCps\Controllers\CategoryController;
use App\Xapis\Stock\WeatherizationProductCps\Controllers\ExportController;
use App\Xapis\Stock\WeatherizationProductCps\Controllers\ProductController;

class SubControllersTab
{
    public static $subaliases_subcontrollers = [
        'products' => ProductController::class,
        'categories' => CategoryController::class,
        'exports' => ExportController::class,
    ];
}
