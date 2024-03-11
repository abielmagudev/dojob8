<?php

namespace App\Models\User\Services;

class RoleCatalogService
{
    protected static $cache;

    protected static $categories = [
        'admin' => [
            // 'SuperAdmin',
            'administrator',
        ],
        'management' => [
            'manager',
            'coordinator',
            'payments', 
        ],
        'field' => [
            'assessor',
            'crew member',
        ],
        'partner' => [
            'contractor',
            'agency',
        ],
    ];

    
    public static function collection()
    {
        if( is_null( self::$cache ) ) {
            self::$cache = collect( self::$categories );
        }

        return self::$cache;
    }

    public static function admin()
    {
        return collect( self::collection()->get('admin') );
    }

    public static function management()
    {
        return collect( self::collection()->get('management') );
    }

    public static function field()
    {
        return collect( self::collection()->get('field') );
    }

    public static function partner()
    {
        return collect( self::collection()->get('partner') );
    }

    public static function categories()
    {
        return collect( self::collection()->keys() );
    }

    public static function roles()
    {
        return self::collection()->flatMap(fn($category) => array_values($category));
    }

    public static function merge(array $categories)
    {
        $values = [];

        foreach(self::$categories as $category => $roles)
        {
            if( in_array($category, $categories) ) {
                $values = array_merge($values, $roles);
            }
        }

        return collect($values);
    }
}
