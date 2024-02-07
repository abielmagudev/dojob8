<?php 

namespace App\Models\Kernel\Traits;

use App\Models\Kernel\Interfaces\Filterable;

trait HasFiltering
{
    public function scopeFiltering($query, array $parameters, array $filters)
    {
        foreach($filters as $parameter => $filter_and_extra_parameters)
        {
            if(! isset($parameters[$parameter]) ) {
                continue;
            }

            if( is_array($filter_and_extra_parameters) )
            {
                $filter = array_shift($filter_and_extra_parameters);

                $arguments = [$parameters[$parameter], ...array_values(
                    array_filter($parameters, function ($k) use ($filter_and_extra_parameters) {
                        return in_array($k, $filter_and_extra_parameters);
                    }, ARRAY_FILTER_USE_KEY)
                )];
            }
            else
            {
                $filter = $filter_and_extra_parameters;
        
                $arguments = [$parameters[$parameter]];
            }

            $query = call_user_func_array([$query, $filter], [...$arguments]);
        }
        
        return $query;
    }

    public function scopeFilterByParameters($query, array $parameters)
    {
        if(! in_array(Filterable::class, class_implements(self::class) ) ) {
            return $query;
        }

        return $query->filtering($parameters, $this->getParameterFilterSettings());
    }
}
