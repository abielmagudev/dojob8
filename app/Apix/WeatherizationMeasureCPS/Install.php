<?php

namespace App\Apix\WeatherizationMeasureCps;

use App\Apix\Installer;

return new class extends Installer
{
    protected $title = 'Weatherization Measures for CPS';

    protected $description = 'Description Weatherization Measures for CPS';

    protected $namespace = __NAMESPACE__;

    protected $classname = 'WeatherizationMeasureCps';

    public function migrations(): array
    {
        return [
            'apix_weatherization_measures_cps_order' => app_path('Apix/WeatherizationMeasureCps/migrations/create_apix_weatherization_measures_cps_order_table.php'),
            'apix_weatherization_measures_cps' => app_path('Apix/WeatherizationMeasureCps/migrations/create_apix_weatherization_measures_cps_table.php'),
        ];
    }
};
