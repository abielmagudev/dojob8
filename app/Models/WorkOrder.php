<?php

namespace App\Models;

use App\Models\Kernel\Interfaces\Filterable;
use App\Models\Kernel\Traits\HasFiltering;
use App\Models\Kernel\Traits\HasHookUsers;
use App\Models\Kernel\Traits\HasScheduledDate;
use App\Models\Kernel\Traits\HasStatus;
use App\Models\WorkOrder\Traits\Actions;
use App\Models\WorkOrder\Traits\Attributes;
use App\Models\WorkOrder\Traits\Filters;
use App\Models\WorkOrder\Traits\InspectionStatus;
use App\Models\WorkOrder\Traits\Mutators;
use App\Models\WorkOrder\Traits\PaymentStatus;
use App\Models\WorkOrder\Traits\Relationships;
use App\Models\WorkOrder\Traits\Scopes;
use App\Models\WorkOrder\Traits\Validators;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkOrder extends Model implements Filterable
{
    // Framework
    use HasFactory;

    // Kernel
    use HasFiltering;
    use HasHookUsers;
    use HasScheduledDate;
    use HasStatus;

    // Owner
    use Actions;
    use Attributes;
    use Filters;
    use Mutators;
    use Relationships;
    use Scopes;
    use Validators;
    use InspectionStatus;
    use PaymentStatus;

    const INITIAL_STATUS = 'new';

    const INITIAL_PAYMENT_STATUS = 'unpaid';

    const INITIAL_INSPECTION_STATUS = 'uninspected';

    protected $fillable = [
        'ordered',
        'status',
        'payment_status',
        'inspection_status',

        'scheduled_date',
        'working_at',
        'done_at',
        'completed_at',
        'working_by',
        'done_by',
        'completed_by',

        'rework_id',
        'warranty_id',
        'client_id',
        'contractor_id',
        'crew_id',
        'job_id',

        'permit_code',
        'notes',
    ];

    protected $casts = [
        'scheduled_date' => 'date',
    ];

    protected static $all_types = [
        'standard',
        'rework',
        'warranty',
    ];

    protected static $all_statuses = [
        'pause',
        'new',
        'working',
        'done',
        'completed',
        'canceled',
        'denialed',
    ];

    protected static $incomplete_statuses = [
        'pause',
        'new',
        'working',
        'done',
    ];

    protected static $closed_statuses = [ 
        'completed',
        'canceled',
        'denialed',
    ];


    // Statics

    public static function collectionAllTypes()
    {
        return collect( self::$all_types );
    }

    public static function collectionAllStatuses($except = [])
    {
        return collect( self::$all_statuses )->reject(function($status) use ($except) {
            return in_array($status, $except);
        });
    }

    public static function collectionIncompleteStatuses($except = [])
    {
        return collect( self::$incomplete_statuses )->reject(function($status) use ($except) {
            return in_array($status, $except);
        });
    }

    public static function collectionClosedStatuses($except = [])
    {
        return collect( self::$closed_statuses )->reject(function($status) use ($except) {
            return in_array($status, $except);
        });
    }
}
