<?php

namespace App\Apix\Stock\WeatherizationMeasureCps;

use App\Apix\Kernel\SetupInterface;
use App\Apix\Stocker;

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

    public function classname(): string
    {
        return 'CpsProductMeasures';
    }

    public function migrations(): array
    {
        return [
            'apix_cpspm_products' => Stocker::path('CpsProductMeasures/migrations/create_apix_cpspm_products_table.php'),
            'apix_cpspm_categories' => Stocker::path('CpsProductMeasures/migrations/create_apix_cpspm_categories_table.php'),
            'apix_cpspm_work_orders' => Stocker::path('CpsProductMeasures/migrations/create_apix_cpspm_work_orders_table.php'),
        ];
    }
};
