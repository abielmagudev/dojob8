<?php

namespace App\Apix\Stock\WeatherizationMeasureCps;

use App\Apix\Kernel\Installer;

return new class extends Installer
{
    protected $name = 'CPS Product Measurements';

    protected $description = 'Description CPS Product Measurements';

    protected $classname = 'CpsProductMeasures';

    public function migrations(): array
    {
        return [
            'apix_cpspm_products' => app_path('Apix/Stock/CpsProductMeasures/migrations/create_apix_cpspm_products_table.php'),
            'apix_cpspm_categories' => app_path('Apix/Stock/CpsProductMeasures/migrations/create_apix_cpspm_categories_table.php'),
            'apix_cpspm_work_orders' => app_path('Apix/Stock/CpsProductMeasures/migrations/create_apix_cpspm_work_orders_table.php'),
        ];
    }
};
