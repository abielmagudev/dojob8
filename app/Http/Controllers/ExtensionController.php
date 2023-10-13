<?php

namespace App\Http\Controllers;

use App\Models\Extension;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ExtensionController extends Controller
{
    public function index(Request $request)
    {
        return view('extensions.index', [
            'extensions' => Extension::all(),
        ]);
    }

    public function show(Request $request, Extension $extension)
    {
        $view = app($extension->controller)->callAction('show', [$request, $extension]);

        return view('extensions.show', [
            'content' => is_a($view, View::class) ? $view->render() : null,
            'extension' => $extension,
        ]);
    }

    public function store(Request $request)
    {
        $extension = Extension::find($request->extension);
        return app($extension->controller)->callAction('store', [$request, $extension]);
    }

    public function update(Request $request, Extension $extension)
    {
        // 
    }

    public function destroy(Request $request, Extension $extension)
    {
        // 
    }
}
