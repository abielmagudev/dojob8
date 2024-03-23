<?php 

namespace App\Models\Media\Services;

use App\Models\Assessment;
use App\Models\Inspection;
use App\Models\Member;
use App\Models\User;
use App\Models\WorkOrder;
use Illuminate\Database\Eloquent\Model;

class MediaFileDirectory
{
    public static $directories = [
        Assessment::class => 'assessments',
        Inspection::class => 'inspections',
        Member::class => 'members',
        User::class => 'users',
        WorkOrder::class => 'work-orders',
    ];

    public static function all()
    {
        return collect( self::$directories );
    }

    public static function base(Model $model)
    {
        return self::all()->get( get_class($model) ); 
    }

    public static function get(Model $model)
    {
        return implode(DIRECTORY_SEPARATOR, [
            self::base($model),
            $model->id,
        ]);
    }
}
