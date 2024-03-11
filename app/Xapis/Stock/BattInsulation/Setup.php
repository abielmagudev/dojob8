<?php

namespace App\Xapis\Stock\BattInsulation;

use App\Xapis\Kernel\SetupInterface;
use App\Xapis\Stocker;

return new class implements SetupInterface
{
    public function name(): string
    {
        return 'Batt Insulation';
    }

    public function description(): string
    {
        return 'Batt material installation form, such as its r-value, square feets, types, sizes and insulation netting.';
    }

    public function spacename(): string
    {
        return 'BattInsulation';
    }

    public function abbr(): string
    {
        return 'BattIns';
    }

    public function migrations(): array
    {
        return [
            'xapi_battins_work_orders' => Stocker::path('BattInsulation/migrations/create_xapi_battins_work_orders_table.php'),
        ]; 
    }
};
