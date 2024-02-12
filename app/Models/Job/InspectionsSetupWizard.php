<?php

namespace App\Models\Job;

use App\Models\Agency;

class InspectionsSetupWizard
{
    public $cache = [];

    public $setup;

    public function __construct($string)
    {
        $this->setup = isJson($string) ? collect( json_decode($string, true) ) : collect([]);
    }


    // Settings

    public function all($json = false)
    {
        return $json ? $this->setup->toJson(JSON_OBJECT_AS_ARRAY) : $this->setup->toArray();
    }

    public function has($key, $value)
    {
        $filtered = $this->setup->filter(function ($setting) use ($key, $value) {
            return $setting[$key] == $value;
        });

        return (bool) count($filtered);
    }

    public function remove($key, $value)
    {
        $this->setup = $this->setup->reject(function ($setting) use ($key, $value) {
            return $setting[$key] == $value;
        });
    }


    // Agencies 

    public function agencies()
    {
        return $this->setup->pluck('agency')->collect();
    }

    public function hasAgency($id)
    {
        return $this->agencies()->contains($id);
    }


    // Static

    public static function map(array $values)
    {
        return array_map(function ($agency) {
            return [
                'agency' => $agency,
            ];
        }, $values['agencies']);
    }

    public static function mapToJson(array $values)
    {
        return json_encode( self::map($values) );
    }
}
