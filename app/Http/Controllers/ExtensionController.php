<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Kernel\ResolveFormRequestsTrait;
use App\Models\Extension;
use Illuminate\Http\Request;
class ExtensionController extends Controller
{
    use ResolveFormRequestsTrait;

    public function __call($method, $parameters)
    {
        $extension = Extension::findOrFail($parameters[0]);

        $method = request()->route()->getActionMethod();

        $request = $this->resolveControllerFormRequest($extension->controller, $method) ?? request();
        
        return app($extension->controller)->callAction($method, [$request, $extension]);
    }

    public function index(Request $request)
    {
        return view('extensions.index', [
            'extensions' => Extension::all(),
        ]);
    }
}
