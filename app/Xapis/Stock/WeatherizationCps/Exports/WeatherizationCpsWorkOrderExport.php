<?php

namespace App\Xapis\Stock\WeatherizationCps\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class WeatherizationCpsWorkOrderExport implements FromView
{
    public $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        return view('WeatherizationCps/views/exports/excel', $this->data);
    }
}
