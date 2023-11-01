<?php

namespace App\Http\Controllers\Kernel;

/**
 * Reflashes the request validation errors('errors') or error message('danger')
 * saved in session for the extension forms of the selected job of the order
 */
trait ReflashInputErrorsTrait
{
    private function reflashInputErrors()
    {
        if( session()->has('errors') || session()->has('danger') ) {
            session()->reflash();
        }
    }
}
