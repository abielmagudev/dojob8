<?php

namespace App\Xapis\Stock\CelluloseInsulation\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Extension;
use App\Xapis\Stock\CelluloseInsulation\Kernel\AreaRvalueCatalog;
use App\Xapis\Stock\CelluloseInsulation\Models\CelluloseInsulationWorkOrder;
use Illuminate\Http\Request;

class CelluloseInsulationController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Extension::class, 'extension');
    }

    public function show(Request $request, Extension $extension)
    {
        return view('CelluloseInsulation.views.show', [
            'extension' => $extension,
            'areas_rvalues' => AreaRvalueCatalog::all(),
            'celluloseins' => new CelluloseInsulationWorkOrder,
        ]);
    }
}
