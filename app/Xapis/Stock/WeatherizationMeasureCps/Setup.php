<?php

namespace App\Xapis\Stock\WeatherizationMeasureCps;

use App\Xapis\Kernel\SetupInterface;
use App\Xapis\Stocker;

return new class implements SetupInterface
{
    public function name(): string
    {
        return 'Weatherization Measures for CPS';
    }

    public function description(): string
    {
        return 'Description Weatherization Measures for CPS';
    }

    public function spacename(): string
    {
        return 'WeatherizationMeasureCps';
    }

    public function migrations(): array
    {
        return [
            'xapi_weatherization_measures_cps' => Stocker::path('WeatherizationMeasureCps/migrations/create_xapi_weatherization_measures_cps_table.php'),
            'xapi_weatherization_products_cps_work_orders' => Stocker::path('WeatherizationMeasureCps/migrations/create_xapi_weatherization_products_cps_work_orders_table.php'),
        ];
    }
};
