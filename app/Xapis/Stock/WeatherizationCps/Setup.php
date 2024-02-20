<?php

namespace App\Xapis\Stock\WeatherizationMeasureCps;

use App\Xapis\Kernel\SetupInterface;
use App\Xapis\Stocker;

return new class implements SetupInterface
{
    public function name(): string
    {
        return 'Weatherization CPS';
    }

    public function description(): string
    {
        return 'Weatherization products cataloged by the CPS company.';
    }

    public function spacename(): string
    {
        return 'WeatherizationCps';
    }

    public function migrations(): array
    {
        return [
            'xapi_weatherization_cps_categories' => Stocker::path('WeatherizationCps/migrations/create_xapi_weatherization_cps_categories_table.php'),
            'xapi_weatherization_cps_products' => Stocker::path('WeatherizationCps/migrations/create_xapi_weatherization_cps_products_table.php'),
            'xapi_weatherization_cps_work_orders' => Stocker::path('WeatherizationCps/migrations/create_xapi_weatherization_cps_work_orders_table.php'),
        ];
    }
};
