<?php

namespace App\Http\Requests\WorkOrderRequest;

use App\Http\Controllers\Kernel\ControllerFormRequestResolver;
use Illuminate\Database\Eloquent\Collection;

trait ResolveExtensionRequestsTrait
{
    public function resolveExtensionRequests(Collection $extensions, string $method)
    {
        $resolved = [];

        foreach($extensions as $extension)
        {
            $resolved[$extension->id] = ControllerFormRequestResolver::make($extension->xapi_work_order_controller, $method);
        }

        return $resolved;
    }
}
