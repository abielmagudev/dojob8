<?php 

namespace App\Models\Kernel;

use Illuminate\Http\Request;

trait HasActionsByRequestTrait
{
    public function scopeActionsForEachInputRequest($query, Request $request, array $inputs_actions)
    {
        foreach($inputs_actions as $input => $action)
        {
            if(! $request->has($input) ) {
                continue;
            }

            $scope_name = is_array($action) ? array_shift($action) : $action;

            $parameters = is_array($action) ? $request->only([$input, ...$action]) : $request->only($input);

            $query = call_user_func_array([$query, $scope_name], [...array_values($parameters)]);
        }
        
        return $query;
    }
    
    /**
     * En caso de no estar definida correctamente la propiedad estatica de $inputs_filters,
     * se provocara una exception por parte del framework para obligar a definirla.
     */
    public function scopeFiltersByRequest($query, Request $request)
    {
        return $query->actionsForEachInputRequest($request, self::$inputs_filters);
    }
}
