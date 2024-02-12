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
use App\Models\WorkOrder\Traits\PaymentStatus;
use App\Models\WorkOrder\Traits\Relationships;
use App\Models\WorkOrder\Traits\Scopes;
use App\Models\WorkOrder\Traits\Validators;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkOrder extends Model implements Filterable
{
    use Actions;
    use Attributes;
    use Filters;
    use InspectionStatus;
    use PaymentStatus;
    use Relationships;
    use Scopes;
    use Validators;
    use HasFactory;
    use HasFiltering;
    use HasHookUsers;
    use HasScheduledDate;
    use HasStatus;

    const INITIAL_STATUS = 'new';

    protected $fillable = [
        'status',
        'payment_status',
        'inspection_status',

        'scheduled_date',
        'working_at',
        'done_at',
        'completed_at',

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

    public static $all_types = [
        'standard',
        'rework',
        'warranty',
    ];

    public static $all_statuses = [
        'pause',
        'new',
        'working',
        'done',
        'completed',
        'canceled',
        'denialed',
    ];

    public static $incomplete_statuses = [ 
        'pause',
        'new',
        'working',
        'done',
    ];

    public static $closed_statuses = [ 
        'completed',
        'canceled',
        'denialed',
    ];

    
    // Statics

    public static function getAllTypes()
    {
        return collect( self::$all_types );
    }

    public static function getAllStatuses()
    {
        return collect( self::$all_statuses );
    }

    public static function getIncompleteStatuses()
    {
        return collect( self::$incomplete_statuses );
    }

    public static function inIncompleteStatuses($value)
    {
        return self::getIncompleteStatuses()->contains($value);
    }

    public static function getClosedStatuses()
    {
        return collect( self::$closed_statuses );
    }

    public static function inClosedStatuses($value)
    {
        return self::getClosedStatuses()->contains($value);
    }
}
