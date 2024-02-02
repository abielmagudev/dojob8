<?php 

namespace App\Models\Kernel;

trait HasFilteringTrait
{
    public function scopeFiltering($query, array $inputs, array $filters)
    {
        foreach($filters as $input => $filter_and_extra_arguments)
        {
            if(! isset($inputs[$input]) ) {
                continue;
            }

            if( is_array($filter_and_extra_arguments) )
            {
                $filter = array_shift($filter_and_extra_arguments);

                $parameters = [$inputs[$input], ...array_values(
                    array_filter($inputs, function ($k) use ($filter_and_extra_arguments) {
                        return in_array($k, $filter_and_extra_arguments);
                    }, ARRAY_FILTER_USE_KEY)
                )];
            }
            else
            {
                $filter = $filter_and_extra_arguments;
        
                $parameters = [$inputs[$input]];
            }

            $query = call_user_func_array([$query, $filter], [...$parameters]);
        }
        
        return $query;
    }

    public function scopeFilterByInputs($query, array $inputs)
    {
        if(! in_array(FilteringInterface::class, class_implements(self::class) ) ) {
            return $query;
        }

        return $query->filtering($inputs, $this->getInputFilterSettings());
    }
}
