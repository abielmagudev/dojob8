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

    public function abbr(): string
    {
        return 'WzProdCps';
    }

    public function migrations(): array
    {
        return [
            'xapi_wzprodcps_categories' => Stocker::path('WeatherizationProductCps/migrations/create_xapi_wzprodcps_categories_table.php'),
            'xapi_wzprodcps_products' => Stocker::path('WeatherizationProductCps/migrations/create_xapi_wzprodcps_products_table.php'),
            'xapi_wzprodcps_work_orders' => Stocker::path('WeatherizationProductCps/migrations/create_xapi_wzprodcps_work_orders_table.php'),
        ]; 
    }

    public function hasSettings(): bool
    {
        return true;
    }
};
