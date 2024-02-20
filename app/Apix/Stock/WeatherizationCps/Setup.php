<?php 

namespace App\Apix\Stock\WeatherizationCps;

use App\Apix\Kernel\SetupInterface;
use App\Apix\Stocker;

return new class implements SetupInterface
{
    public function name(): string
    {
        return 'Weatherization CPS';
    }

    public function description(): string
    {
        return 'Installation of weatherization products cataloged by the CPS company.';
    }

    public function spacename(): string
    {
        return 'WeatherizationCps';
    }

    public function migrations(): array
    {
        return [
            'apix_weatherization_cps' => Stocker::path('WeatherizationCps/migrations/create_apix_weatherization_cps_table.php'),
        ];
    }
};
