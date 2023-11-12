<?php

namespace App\Apix\CpsProductMeasures\Controllers;

use App\Apix\Kernel\CallSubcontrollersTrait;
use App\Http\Controllers\Controller;
use App\Models\Extension;
use Illuminate\Http\Request;

class CpsProductMeasuresController extends Controller
{
    use CallSubcontrollersTrait;

    public static $subaliases_subcontrollers = [
        'category' => CategoryController::class,
        'product' => ProductController::class,
        'exports' => ExportController::class,
    ];

    public function show(Request $request, Extension $extension)
    {
        return $this->callSubcontroller($request->get('sub', 'product'), 'index', [$extension]);
    }

    public function create(Request $request, Extension $extension)
    {
        return $this->callSubcontroller($request->sub, 'create', [$extension]);
    }

    public function store(Request $request, Extension $extension)
    {
        return $this->callSubcontroller($request->sub, 'store', [$extension]);
    }

    public function edit(Request $request, Extension $extension)
    {
        return $this->callSubcontroller($request->sub, 'edit', [$extension]);
    }

    public function update(Request $request, Extension $extension)
    {
        return $this->callSubcontroller($request->sub, 'update', [$extension]);
    }

    public function destroy(Request $request, Extension $extension)
    {
        return $this->callSubcontroller($request->sub, 'destroy', [$extension]);
    }
}
