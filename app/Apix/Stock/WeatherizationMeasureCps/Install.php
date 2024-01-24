<?php

namespace App\Apix\Stock\WeatherizationMeasureCps;

use App\Apix\Kernel\Installer;

return new class extends Installer
{
    protected $name = 'Weatherization Measures for CPS';

    protected $description = 'Description Weatherization Measures for CPS';

    protected $classname = 'WeatherizationMeasureCps';

    public function migrations(): array
    {
        return [
            'apix_weatherization_measures_cps' => app_path('Apix/Stock/WeatherizationMeasureCps/migrations/create_apix_weatherization_measures_cps_table.php'),
            'apix_weatherization_products_cps_work_orders' => app_path('Apix/Stock/WeatherizationMeasureCps/migrations/create_apix_weatherization_products_cps_work_orders_table.php'),
        ];
    }
};
