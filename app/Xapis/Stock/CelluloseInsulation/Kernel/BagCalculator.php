<?php

namespace App\Xapis\Stock\CelluloseInsulation\Kernel;

use DivisionByZeroError;

class BagCalculator
{
    public static function calculate($square_footage, $rvalue_score)
    {
        try
        {
            return (int) ceil( $square_footage / $rvalue_score );
        } 
        catch(DivisionByZeroError $e)
        {
            return 0;
        }
    }
}
