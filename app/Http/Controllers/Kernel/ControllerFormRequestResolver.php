<?php 

namespace App\Http\Controllers\Kernel;

use Illuminate\Http\Request;
use ReflectionMethod;

class ControllerFormRequestResolver
{
    public $reflection;

    public function __construct(string $controller, string $method)
    {
        $this->reflection = new ReflectionMethod($controller, $method);
    }

    public function filter()
    {
        return array_filter($this->reflection->getParameters(), function ($parameter) {
            return is_a($parameter->getType()->getName(), Request::class) || is_subclass_of($parameter->getType()->getName(), Request::class);
        });      
    }

    public function get()
    {
        return array_map(function ($item) {
            return $item->getType()->getName();
        }, $this->filter());
    }

    public function resolve()
    {
        return array_map(function ($class) {
            return app()->make( $class );
        }, $this->get());
    }

    public static function make(string $controller, string $method)
    {
        return (new self($controller, $method))->resolve();
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
