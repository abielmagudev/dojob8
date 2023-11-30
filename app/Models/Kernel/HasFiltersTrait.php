<?php 

namespace App\Models\Kernel;

use Illuminate\Http\Request;

trait HasFiltersTrait
{
    public function scopeFiltersByRequest($query, Request $request)
    {
        $inputs_values = $request->only(
            array_keys(self::$inputs_filters)
        );

        foreach($inputs_values as $input => $value)
        {
            $filter_additional_parameters = self::$inputs_filters[$input];
            
            if( is_array($filter_additional_parameters) )
            {
                $filter = array_shift($filter_additional_parameters);
                $additional_parameters = array_values($request->only($filter_additional_parameters));
            } 
            else
            {
                $filter = $filter_additional_parameters;
                $additional_parameters = [];
            }

            $query = call_user_func_array([$query, $filter], [$value, ...$additional_parameters]);
        }
        
        return $query;
    }
}
