<?php

namespace App\Xapis\Stock\WeatherizationMeasureCps;

use App\Xapis\Kernel\SetupInterface;
use App\Xapis\Stocker;

return new class implements SetupInterface
{
    public function name(): string
    {
        return 'Weatherization Products by CPS';
    }

    public function description(): string
    {
        return 'Weatherization products cataloged by the CPS company.';
    }

    public function spacename(): string
    {
        return 'WeatherizationProductCps';
    }

    public function migrations(): array
    {
        return [
            'xapi_weatherization_product_cps_categories' => Stocker::path('WeatherizationProductCps/migrations/create_xapi_weatherization_product_cps_categories_table.php'),
            'xapi_weatherization_product_cps_products' => Stocker::path('WeatherizationProductCps/migrations/create_xapi_weatherization_product_cps_products_table.php'),
            'xapi_weatherization_product_cps_work_orders' => Stocker::path('WeatherizationProductCps/migrations/create_xapi_weatherization_product_cps_work_orders_table.php'),
        ]; 
    }
};
