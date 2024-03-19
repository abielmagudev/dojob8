<?php



// Validators

/**
 * If the condition $verified is true, it returns "selected" for the select element option.
 */
if(! function_exists('isSelected') )
{
    function isSelected(bool $verified, $default = ''): string
    {
        return $verified ? 'selected' : $default;
    }
}

/**
 * If the condition $verified is true, it returns "checked" for the checkbox element.
 */
if(! function_exists('isChecked') )
{
    function isChecked(bool $verified, $default = ''): string
    {
        return $verified ? 'checked' : $default;
    }
}

/**
 * If the condition $verified is true, it returns "disabled" for the input element.
 */
if(! function_exists('isDisabled') )
{
    function isDisabled(bool $verified, $default = ''): string
    {
        return $verified ? 'disabled' : $default;
    }
}

/**
 * If the condition $verified is true, it returns "autofocus" to make the input element focus.
 */
if(! function_exists('isAutofocused') )
{
    function isAutofocused(bool $verified, $default = ''): string
    {
        return $verified ? 'autofocus' : $default;
    }
}

/**
 * Validates if the $value has a string in json format
 */
if(! function_exists('isJson') )
{
    function isJson($value): bool
    {
        if(! is_string($value) ) {
            return false;
        }

        json_decode($value);

        return json_last_error() === JSON_ERROR_NONE;
    }
}

/**
 * Strictly validate if the $request of framework is ajax
 */
if(! function_exists('isAjaxRequest') )
{
    function isAjaxRequest(\Illuminate\Http\Request $request): bool
    {
        return $request->ajax() || 
               $request->wantsJson() || 
               $request->expectsJson() || 
               $request->header('X-Requested-With') == 'XMLHttpRequest';
    }
}



// Http

/**
 * Escapes the framework environment to obtain the requested value directly from the $_COOKIE variable.
 */
if(! function_exists('requestCookieRaw') )
{
    function requestCookieRaw(string $name, $default = null)
    {
        return array_key_exists($name, $_COOKIE) ? $_COOKIE[$name] : $default;
    }
}



// Controllers

if(! function_exists('workOrderUrlGenerator') )
{
    function workOrderUrlGenerator(string $method, array $parameters = [])
    {
        return call_user_func([\App\Http\Controllers\WorkOrderController\Services\WorkOrderUrlGenerator::class, $method], $parameters);
    }
} 

if(! function_exists('paymentUrlGenerator') )
{
    function paymentUrlGenerator(string $method, array $parameters = [])
    {
        return call_user_func([\App\Http\Controllers\PaymentController\Services\PaymentUrlGenerator::class, $method], $parameters);
    }
} 

if(! function_exists('inspectionUrlGenerator') )
{
    function inspectionUrlGenerator(string $method, array $parameters = [])
    {
        return call_user_func([\App\Http\Controllers\InspectionController\InspectionUrlGenerator::class, $method], $parameters);
    }
} 




// Bootstrap 

/**
 * If the condition $verified is true, return the bootstrap class to give it an invalid style.
 */
if(! function_exists('bsInputInvalid') )
{
    function bsInputInvalid(bool $is_invalid)
    {
        return $is_invalid ? 'is-invalid' : '';
    }
}

/**
 * If the condition is true, it returns the bootstrap class to give it active style.
 */
if(! function_exists('bsControlActive') )
{
    function bsControlActive(bool $verified, $default = '')
    {
        return $verified ? 'active' : $default;
    }
}




// Misc

/**
 * Looks for the $needle fragment in of the $text and wraps it with the mark tag
 */
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

/**
 * Takes the initials of each word in the text to return a string in lowercase or uppercase style.
 */
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

/**
 * Use Str::class with helper functions
 */
if(! function_exists('title') )
{
    function title(string $text)
    {
        return \Illuminate\Support\Str::title( trim($text) );
    }
}

if(! function_exists('camelCase') )
{
    function camelCase(string $text)
    {
        return \Illuminate\Support\Str::camel( trim($text) );
    }
}

if(! function_exists('snakeCase') )
{
    function snakeCase(string $text)
    {
        return \Illuminate\Support\Str::snake( trim($text) );
    }
}

if(! function_exists('slugCase') )
{
    function slugCase(string $text)
    {
        return \Illuminate\Support\Str::slug( trim($text) );
    }
}

if(! function_exists('studlyCase') )
{
    function studlyCase(string $text)
    {
        return \Illuminate\Support\Str::studly( trim($text) );
    }
}

/**
 * Converts a string in date format "Y-m-d" to a string in human-readable format.
 */
if(! function_exists('humanDateFormat') )
{
    function humanDateFormat(string $date, $format = 'D d M, Y')
    {
        return Carbon\Carbon::parse($date)->format($format);
    }
}

/**
 * Converts a array to json for print on element HTML(Double quotes fixed).
 */
if(! function_exists('jsonEncodeHtml') )
{
    function jsonEncodeHtml(array $elements)
    {
        return htmlspecialchars(
            json_encode($elements),
            ENT_QUOTES,
            'UTF-8'
        );
    }
}
