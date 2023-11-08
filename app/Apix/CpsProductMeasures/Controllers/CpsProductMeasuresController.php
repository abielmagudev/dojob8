<?php

namespace App\Apix\CpsProductMeasures\Controllers;

use App\Apix\CpsProductMeasures\Requests\SaveRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Kernel\ControllerFormRequestResolver;
use App\Models\Extension;
use Illuminate\Http\Request;

class CpsProductMeasuresController extends Controller
{
    public static $concepts_subcontrollers = [
        'category' => CategoryController::class,
        'product' => ProductController::class,
    ];

    private function callActionByConcept(string $concept = null, string $method, array $parameters)
    {
        if(! array_key_exists($concept, self::$concepts_subcontrollers) ) {
            return abort(404);
        }

        $controller = self::$concepts_subcontrollers[$concept];

        $requests = ControllerFormRequestResolver::make($controller, $method);

        return app($controller)->callAction($method, [...$requests, ...$parameters]);
    }

    public function show(Request $request, Extension $extension)
    {
        return $this->callActionByConcept($request->get('concept', 'product'), 'index', [$extension]);
    }

    public function create(Request $request, Extension $extension)
    {
        return $this->callActionByConcept($request->concept, 'create', [$extension]);
    }

    public function store(Request $request, Extension $extension)
    {
        return $this->callActionByConcept($request->concept, 'store', [$extension]);
    }

    public function edit(Request $request, Extension $extension)
    {
        return $this->callActionByConcept($request->concept, 'edit', [$extension]);
    }

    public function update(Request $request, Extension $extension)
    {
        return $this->callActionByConcept($request->concept, 'update', [$extension]);
    }

    public function destroy(Request $request, Extension $extension)
    {
        return $this->callActionByConcept($request->concept, 'destroy', [$extension]);
    }
}
