<?php

namespace App\Xapis\Stock\CpsProductMeasures\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class WorkOrderProductMeasuresExport implements FromView
{
    public $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        return view('CpsProductMeasures/views/exports/excel', $this->data);
    }
}
