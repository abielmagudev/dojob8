<?php

namespace App\Xapis\Stock\WeatherizationMeasureCps;

use App\Xapis\Kernel\SetupInterface;
use App\Xapis\Stocker;

return new class implements SetupInterface
{
    public function name(): string
    {
        return 'CPS Product Measurements';
    }

    public function description(): string
    {
        return 'Description CPS Product Measurements';
    }

    public function spacename(): string
    {
        return 'CpsProductMeasures';
    }

    public function migrations(): array
    {
        return [
            'xapi_cpspm_products' => Stocker::path('CpsProductMeasures/migrations/create_xapi_cpspm_products_table.php'),
            'xapi_cpspm_categories' => Stocker::path('CpsProductMeasures/migrations/create_xapi_cpspm_categories_table.php'),
            'xapi_cpspm_work_orders' => Stocker::path('CpsProductMeasures/migrations/create_xapi_cpspm_work_orders_table.php'),
        ];
    }
};
