<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Kernel\ResolveFormRequestsTrait;
use App\Models\Extension;
use Illuminate\Http\Request;
class ExtensionController extends Controller
{
    use ResolveFormRequestsTrait;

    public function index(Request $request)
    {
        return view('extensions.index', [
            'extensions' => Extension::all(),
        ]);
    }

    public function show(Request $request, Extension $extension)
    {
        return app($extension->controller)->callAction('show', [$request, $extension]);
    }

    public function create(Request $request, Extension $extension)
    {
        return app($extension->controller)->callAction('create', [$request, $extension]);
    }

    public function store(Request $request, Extension $extension)
    {
        return app($extension->controller)->callAction('store', [
            $this->resolveControllerFormRequest($extension->controller, 'store') ?? $request, 
            $extension
        ]);
    }

    public function edit(Request $request, Extension $extension)
    {
        return app($extension->controller)->callAction('edit', [$request, $extension]);
    }

    public function update(Request $request, Extension $extension)
    {
        return app($extension->controller)->callAction('update', [$request, $extension]);
    }

    public function destroy(Request $request, Extension $extension)
    {
        return app($extension->controller)->callAction('destroy', [$request, $extension]);
    }
}
