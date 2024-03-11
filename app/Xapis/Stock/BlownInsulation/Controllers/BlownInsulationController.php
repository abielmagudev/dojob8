<?php

namespace App\Xapis\Stock\BlownInsulation\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Extension;
use App\Xapis\Stock\BlownInsulation\Kernel\RvalueManager;
use App\Xapis\Stock\BlownInsulation\Models\BlownInsulationWorkOrder;
use Illuminate\Http\Request;

class BlownInsulationController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Extension::class, 'extension');
    }

    public function show(Request $request, Extension $extension)
    {
        return view('BlownInsulation.views.show', [
            'extension' => $extension,
            'spaces' => RvalueManager::spaces(),
            'rvalues' => RvalueManager::all(),
            'blownins' => new BlownInsulationWorkOrder,
        ]);
    }
}
