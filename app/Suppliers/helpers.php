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

if(! function_exists('isJson') )
{
    function isJson($value)
    {
        if(! is_string($value) ) {
            return false;
        }

        json_decode($value);

        return json_last_error() === JSON_ERROR_NONE;
    }
}

if(! function_exists('initials') )
{
    function initials(string $string, $to_uppercase = true)
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

if(! function_exists('humanDateFormat') )
{
    function humanDateFormat(string $date, $format = 'D d M, Y')
    {
        return Carbon\Carbon::parse($date)->format($format);
    }
}

if(! function_exists('requestCookieRaw') )
{
    function requestCookieRaw(string $name, $default = null)
    {
        return array_key_exists($name, $_COOKIE) ? $_COOKIE[$name] : $default;
    }
}

if(! function_exists('isAjaxRequest') )
{
    function isAjaxRequest(\Illuminate\Http\Request $request)
    {
        return $request->ajax() || 
               $request->wantsJson() || 
               $request->expectsJson() || 
               $request->header('X-Requested-With') == 'XMLHttpRequest';
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

if(! function_exists('bsControlActive') )
{
    function bsControlActive(bool $verified, $default = '')
    {
        return $verified ? 'active' : $default;
    }
}
