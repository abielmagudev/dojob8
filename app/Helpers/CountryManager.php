<?php

namespace App\Helpers;

class CountryManager
{
    public static $instance;

    public $countries;

    private function __construct()
    {
        $this->countries = collect( config('countries') )->map(function ($country) {
            return collect($country);
        });
    }

    public static function singleton()
    {
        if( is_null(self::$instance) ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public static function all()
    {
        return self::singleton()->countries;
    }

    public static function codes()
    {
        return self::singleton()->countries->keys();
    }

    public static function exists(string $code)
    {
        return self::singleton()->countries->has($code);
    }

    public static function get(string $code)
    {
        return self::singleton()->countries->get($code);
    }

    public static function only($parameter)
    {
        $codes = is_array($parameter) ? $parameter : [$parameter];

        return self::all()->only($codes);
    }

    public static function except($parameter)
    {
        $codes = is_array($parameter) ? $parameter : [$parameter];

        return self::all()->except($codes);
    }
}
