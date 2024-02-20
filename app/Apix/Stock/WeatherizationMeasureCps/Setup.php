<?php

namespace App\Apix\Stock\WeatherizationMeasureCps;

use App\Apix\Kernel\SetupInterface;
use App\Apix\Stocker;

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

    public function classname(): string
    {
        return 'WeatherizationMeasureCps';
    }

    public function migrations(): array
    {
        return [
            'apix_weatherization_measures_cps' => Stocker::path('WeatherizationMeasureCps/migrations/create_apix_weatherization_measures_cps_table.php'),
            'apix_weatherization_products_cps_work_orders' => Stocker::path('WeatherizationMeasureCps/migrations/create_apix_weatherization_products_cps_work_orders_table.php'),
        ];
    }
};
