<?php

namespace App\Models\User;

use App\Models\Agency;
use App\Models\Contractor;
use App\Models\Member;
use PHPUnit\Framework\MockObject\ReturnValueNotConfiguredException;

class UserRole
{
    public static $classnames_roles = [
        Agency::class => [
            'agency',
        ],
        Contractor::class => [
            'contractor'
        ],
        Member::class => [
            'admin',
            'director',
            'coordinator',
            'assessor',
            'worker',
            'payments',
        ],
    ];

    public static function collection()
    {
        return collect( self::$classnames_roles );
    }

    public static function getRolesByClassname(string $classname)
    {
        return collect( self::collection()->get($classname) );
    }
}
