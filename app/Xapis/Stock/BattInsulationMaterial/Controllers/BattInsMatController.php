<?php

namespace App\Xapis\Stock\BattInsulationMaterial\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Extension;
use Illuminate\Http\Request;

class BattInsMatController extends Controller
{
    public function show(Request $request, Extension $extension)
    {
        return view('BattInsulationMaterial.views.show', [
            'extension' => $extension,
        ]);
    }
}
