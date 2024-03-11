<?php

namespace App\Xapis\Stock\BlownInsulation;

use App\Xapis\Kernel\SetupInterface;
use App\Xapis\Stocker;

return new class implements SetupInterface
{
    public function name(): string
    {
        return 'Cellulose Insulation';
    }

    public function description(): string
    {
        return 'Cellulose material installation form.';
    }

    public function spacename(): string
    {
        return 'CelluloseInsulation';
    }

    public function abbr(): string
    {
        return 'CelluloseIns';
    }

    public function migrations(): array
    {
        return [
            'xapi_celluloseins_work_orders' => Stocker::path('CelluloseInsulation/migrations/create_xapi_celluloseins_work_orders_table.php'),
        ]; 
    }
};
