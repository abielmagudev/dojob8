<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Kernel\ControllerFormRequestResolver;
use App\Models\Extension;
use Illuminate\Http\Request;
class ExtensionController extends Controller
{
    public function __call($method, $parameters)
    {
        $extension = Extension::findOrFail($parameters[0]);

        $method = request()->route()->getActionMethod();

        $requests = ControllerFormRequestResolver::make($extension->xapi_controller, $method);

        return app($extension->xapi_controller)->callAction($method, [...$requests, $extension]);
    }

    public function index()
    {
        return view('extensions.index')->with('extensions', Extension::all());
    }
}
