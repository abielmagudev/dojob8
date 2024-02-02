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

if(! function_exists('isDisabled') )
{
    function isDisabled(bool $verified, $default = '')
    {
        return $verified ? 'disabled' : $default;
    }
}

if(! function_exists('isAutofocused') )
{
    function isAutofocused(bool $verified, $default = '')
    {
        return $verified ? 'autofocus' : $default;
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
    function marker($needle, string $text)
    {
        if( is_null($needle) || trim($needle) == '' ) {
            return $text;
        }

        return preg_replace("/({$needle})/i", "<mark class='px-0'>$1</mark>", $text);
    }
}

if(! function_exists('title') )
{
    function title(string $text)
    {
        return \Illuminate\Support\Str::title( trim($text) );
    }
}


// Bootstrap

if(! function_exists('bsInputInvalid') )
{
    function bsInputInvalid(bool $is_invalid)
    {
        return $is_invalid ? 'is-invalid' : '';
    }
}

if(! function_exists('bsElementActived') )
{
    function bsIsActived(bool $verified, $default = '')
    {
        return $verified ? 'active' : $default;
    }
}
