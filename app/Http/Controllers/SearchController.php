<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public static $controllers = [
        'client' => ClientController::class,
        'work-order' => WorkOrderController::class,
    ];

    public function __invoke(Request $request)
    {        
        if(! self::existsController( $request->get('topic') ) ) {
            return back();
        }

        $controller = self::getController( $request->get('topic') );

        $request->merge([
            'search' => $request->get('value'),
            'dates' => 'any',
        ]);

        return app()->call([$controller, 'index'], [$request]);
    }

    public static function existsController($key)
    {
        return isset(self::$controllers[$key]);
    }

    public static function getController($key)
    {
        return self::$controllers[$key];
    }
}
