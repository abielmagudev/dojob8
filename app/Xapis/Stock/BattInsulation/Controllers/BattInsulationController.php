<?php

namespace App\Xapis\Stock\BattInsulation\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Extension;
use App\Xapis\Stock\BattInsulation\Kernel\Rvalue;
use App\Xapis\Stock\BattInsulation\Kernel\Size;
use App\Xapis\Stock\BattInsulation\Kernel\Type;
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
            'rvalues_by_space' => Rvalue::collection(),
            'sizes' => Size::all(),
            'types' => Type::all(),
            'battins' => new BattInsulationWorkOrder,
        ]);
    }
}
