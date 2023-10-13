<?php

namespace App\Apix\WeatherizationMeasureCPS;

use App\Apix\Installer;

return new class extends Installer
{
    protected $title = 'Weatherization Measure of CPS';

    protected $description = 'Description of Weatherization Measure of CPS';

    protected $namespace = __NAMESPACE__;

    public function migrations(): array
    {
        return [
            'apix_weatherization_measure_cps_products' => app_path('Apix/WeatherizationMeasureCPS/migrations/create_apix_weatherization_measure_cps_products_table.php'),
        ];
    }
};
