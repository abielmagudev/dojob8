<?php

namespace App\Xapis\Stock\WeatherizationProductCps\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class WpCpsWorkOrderExport implements FromView
{
    public $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        return view('WeatherizationProductCps/views/exports/excel', $this->data);
    }
}
