<?php

namespace App\Models\User;

use App\Models\Agency;
use App\Models\Contractor;

class UserRoleClassifier
{    
    protected static $admin_roles = [
        'SuperAdmin',
        'administrator',
        'manager',
        'coordinator',
        'payments',
    ];

    protected static $non_admin_roles = [
        'agency',
        'assessor',
        'contractor',
        'worker',  
    ];

    protected static $field_roles = [
        'assessor',
        'worker',
    ];

    protected static $partner_roles = [
        'contractor',
        'agency',
    ];

    protected static $cache = [];

    private static function cache($key, $value)
    {
        if(! array_key_exists($key, self::$cache) ) {
            self::$cache[$key] = collect($value);
        }

        return self::$cache[$key];
    }

    public static function collectionAdminRoles()
    {
        return self::cache('admin_roles', self::$admin_roles);
    }

    public static function collectionNonAdminRoles()
    {
        return self::cache('non_admin_roles', self::$non_admin_roles);
    }

    public static function collectionFieldRoles()
    {
        return self::cache('field_roles', self::$field_roles);
    }

    public static function collectionPartnerRoles()
    {
        return self::cache('partner_roles', self::$partner_roles);
    }

    public static function getRolesBelongModel(string $model_class)
    {
        if( in_array($model_class, [Agency::class, Contractor::class])) {
            return self::collectionPartnerRoles();
        }

        // Member Model
        return self::collectionAdminRoles()->merge(
            self::collectionFieldRoles()->toArray()
        );
    }
}
