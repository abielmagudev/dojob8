<?php

namespace App\Http\Controllers\Kernel;

use Illuminate\Http\Request;
use ReflectionMethod;

trait ResolveFormRequestsTrait
{
    public function resolveFormRequest(string $formRequestClass)
    {
        return app()->make($formRequestClass);
    }

    public function getFormRequestClassParameterController(string $controllerClass, string $method)
    {
        $reflection = new ReflectionMethod($controllerClass, $method);

        $filtered = array_filter($reflection->getParameters(), function ($parameter) {
            return $parameter->getName() == 'request' && $parameter->getType() <> Request::class;
        });

        return count($filtered) ? $filtered[0]->getType()->getName() : null;
    }

    public function resolveControllerFormRequest(string $controllerClass, string $method, $default = null)
    {
        $formRequestClass = $this->getFormRequestClassParameterController($controllerClass, $method);

        if( empty($formRequestClass) ||! class_exists($formRequestClass) )
            return $default; // If does not have a form request

        return $this->resolveFormRequest($formRequestClass);
    }
}

/*

// Resolver manualmente un form request
$miFormRequest = app(MiFormRequest::class);

// O puedes usar el método resolve directamente
// $miFormRequest = app()->make(MiFormRequest::class);

// Validar la solicitud manualmente
$miFormRequest->initialize(
    $request->query(),
    $request->request->all(),
    $request->attributes->all(),
    $request->cookies->all(),
    $request->files->all(),
    $request->server->all()
);

$miFormRequest->setUserResolver($request->getUserResolver());
$miFormRequest->setRouteResolver($request->getRouteResolver());

$miFormRequest->validate();

// ... Resto de la lógica del controlador

En este ejemplo, estamos utilizando el método app para resolver 
manualmente una instancia del form request MiFormRequest. 
Luego, inicializamos manualmente la instancia con los datos de 
la solicitud actual y llamamos al método validate para realizar 
la validación.

Ten en cuenta que esto es una solución manual y deberías considerarla 
solo en situaciones donde la inyección automática no es posible o práctica. 
En la mayoría de los casos, la inyección automática de Laravel proporciona 
una forma más limpia y mantenible de manejar las dependencias.

*/
