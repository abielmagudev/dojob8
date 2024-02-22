<?php

namespace App\Xapis\Stock\WeatherizationProductCps\Controllers;

use App\Xapis\Kernel\CallSubcontrollersTrait;
use App\Http\Controllers\Controller;
use App\Models\Extension;
use Illuminate\Http\Request;

class WpCpsController extends Controller
{
    use CallSubcontrollersTrait;

    public static $subaliases_subcontrollers = [
        'products' => ProductController::class,
        'categories' => CategoryController::class,
        'exports' => ExportController::class,
    ];

    public function show(Request $request, Extension $extension)
    {
        return $this->callSubcontroller($request->get('sub', 'products'), 'index', [$extension]);
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
