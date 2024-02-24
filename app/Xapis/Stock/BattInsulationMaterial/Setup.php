<?php

namespace App\Xapis\Stock\AtticInsulationmatulator;

use App\Xapis\Kernel\SetupInterface;
use App\Xapis\Stocker;

return new class implements SetupInterface
{
    public function name(): string
    {
        return 'Batt Insulation Material';
    }

    public function description(): string
    {
        return 'Batt material installation form, such as its r-value, square feets, types, sizes and insulation netting.';
    }

    public function spacename(): string
    {
        return 'BattInsulationMaterial';
    }

    public function abbr(): string
    {
        return 'BattInsMat';
    }

    public function migrations(): array
    {
        return [
            'xapi_battinsmat_work_orders' => Stocker::path('BattInsulationMaterial/migrations/create_xapi_battinsmat_work_orders_table.php'),
        ]; 
    }

    public function hasSettings(): bool
    {
        return false;
    }
};
