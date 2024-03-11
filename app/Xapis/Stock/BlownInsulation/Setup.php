<?php

namespace App\Xapis\Stock\BlownInsulation;

use App\Xapis\Kernel\SetupInterface;
use App\Xapis\Stocker;

return new class implements SetupInterface
{
    public function name(): string
    {
        return 'Blown Insulation';
    }

    public function description(): string
    {
        return 'Blown material installation form.';
    }

    public function spacename(): string
    {
        return 'BlownInsulation';
    }

    public function abbr(): string
    {
        return 'BlownIns';
    }

    public function migrations(): array
    {
        return [
            'xapi_blownins_work_orders' => Stocker::path('BlownInsulation/migrations/create_xapi_blownins_work_orders_table.php'),
        ]; 
    }
};
