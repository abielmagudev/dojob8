<?php

if(! function_exists('isSelected') )
{
    function isSelected(bool $verified, $default = '')
    {
        return $verified ? 'selected' : $default;
    }
}

if(! function_exists('isChecked') )
{
    function isChecked(bool $verified, $default = '')
    {
        return $verified ? 'checked' : $default;
    }
}

if(! function_exists('bsInputInvalid') )
{
    function bsInputInvalid(bool $is_invalid)
    {
        return $is_invalid ? 'is-invalid' : '';
    }
}

if(! function_exists('wordInitials') )
{
    function wordInitials(string $string, $to_uppercase = true)
    {
        preg_match_all('/(?<=\b)\w/iu', $string, $matches);

        if( $to_uppercase ) {
            return mb_strtoupper( implode($matches[0]) );
        }

        return implode($matches[0]);
    }
}

if(! function_exists('marker') )
{
    function marker(string $needle, string $text)
    {
        return preg_replace("/({$needle})/i", "<mark>$1</mark>", $text);
    }
}


// Models

if(! function_exists('workOrderUrlGenerator') )
{
    function workOrderUrlGenerator(string $method, array $parameters = [])
    {
        return call_user_func([App\Models\WorkOrder\WorkOrderUrlGenerator::class, $method], $parameters);
    }
}

if(! function_exists('inspectionUrlGenerator') )
{
    function inspectionUrlGenerator(string $method, array $parameters = [])
    {
        return call_user_func([App\Models\Inspection\InspectionUrlGenerator::class, $method], $parameters);
    }
}
