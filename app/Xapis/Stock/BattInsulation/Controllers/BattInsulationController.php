<?php

namespace App\Xapis\Stock\BattInsulation\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Extension;
use App\Xapis\Stock\BattInsulation\Kernel\AreaRvalueCatalog;
use App\Xapis\Stock\BattInsulation\Kernel\SizeCatalog;
use App\Xapis\Stock\BattInsulation\Kernel\TypeCatalog;
use App\Xapis\Stock\BattInsulation\Models\BattInsulationWorkOrder;
use Illuminate\Http\Request;

class BattInsulationController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Extension::class, 'extension');
    }

    public function show(Request $request, Extension $extension)
    {
        return view('BattInsulation.views.show', [
            'extension' => $extension,
            'areas_rvalues' => AreaRvalueCatalog::all(),
            'sizes' => SizeCatalog::all(),
            'types' => TypeCatalog::all(),
            'battins' => new BattInsulationWorkOrder,
        ]);
    }
}
