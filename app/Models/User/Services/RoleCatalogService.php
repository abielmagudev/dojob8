<?php

namespace App\Models\User\Services;

class RoleCatalogService
{
    protected static $cache;

    protected static $catalog_roles = [
        'admin' => [
            'SuperAdmin',
            'administrator',
            'payments', 
            'manager',
            'coordinator',
        ],
        'field' => [
            'assessor',
            'worker',
        ],
        'partner' => [
            'contractor',
            'agency',
        ],
    ];

    
    public static function collection()
    {
        if( is_null( self::$cache ) ) {
            self::$cache = collect( self::$catalog_roles );
        }

        return self::$cache;
    }

    public static function admin()
    {
        return self::collection()->get('admin');
    }

    public static function field()
    {
        return self::collection()->get('field');
    }

    public static function partner()
    {
        return self::collection()->get('partner');
    }

    public static function merge(array $catalogs)
    {
        $values = [];

        foreach(self::$catalog_roles as $catalog => $roles)
        {
            if( in_array($catalog, $catalogs) ) {
                $values = array_merge($values, $roles);
            }
        }

        return collect($values);
    }
}
