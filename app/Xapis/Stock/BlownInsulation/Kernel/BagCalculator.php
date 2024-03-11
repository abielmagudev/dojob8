<?php

namespace App\Xapis\Stock\BlownInsulation\Kernel;

class BagCalculator
{
    public static function get(string $space, $rvalue_name, $square_footage)
    {
        $rvalue_score = RvalueManager::rvalueScoreBySpace($space, $rvalue_name);

        if(! empty($rvalue_score) &&! empty($square_footage) ) {
            return ceil( $square_footage / $rvalue_score) ;
        }
        
        return 0;
    }
}
