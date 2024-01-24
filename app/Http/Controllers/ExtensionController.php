<?php

namespace App\Http\Controllers;

use App\Apix\Register;
use App\Http\Controllers\Kernel\ControllerFormRequestResolver;
use App\Models\Extension;
use Illuminate\Http\Request;
class ExtensionController extends Controller
{
    public function __call($method, $parameters)
    {
        $extension = Extension::findOrFail($parameters[0]);

        $method = request()->route()->getActionMethod();

        $requests = ControllerFormRequestResolver::make($extension->controller, $method);

        return app($extension->controller)->callAction($method, [...$requests, $extension]);
    }

    public function index(Request $request)
    {
        return view('extensions.index', [
            'extensions' => Extension::all(),
        ]);
    }
}
