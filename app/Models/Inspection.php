<?php

namespace App\Models;

use App\Models\Kernel\Interfaces\Filterable;
use App\Models\Kernel\Traits\HasFiltering;
use App\Models\Kernel\Traits\HasHookUsers;
use App\Models\Kernel\Traits\HasScheduledDate;
use App\Models\Kernel\Traits\HasStatus;
use App\Models\WorkOrder\Associated\BelongWorkOrderTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inspection extends Model implements Filterable
{
    use BelongWorkOrderTrait;
    use HasFactory;
    use HasFiltering;
    use HasHookUsers;
    use HasScheduledDate;
    use HasStatus;

    protected $fillable = [
        'scheduled_date',
        'observations',
        'inspector_name',
        'status',
        'agency_id',
        'crew_id',
        'work_order_id',
    ];

    protected $casts = [
        'scheduled_date' => 'date',
    ];

    public static $all_statuses = [
        'pending',
        'on hold',
        'passed',
        'failed',
    ];

    public static $attributes_for_pending_statuses = [
        'scheduled',
        'scheduled_date',
    ];

    
    // Interface

    public function getParameterFilterSettings(): array
    {
        return [
            'crew' => 'filterByCrew',
            'agency' => 'filterByAgency',
            'dates' => 'filterByScheduledDateBetween',
            'scheduled_date' => 'filterByScheduledDate',
            'status_group' => 'filterByStatusGroup',
            'status' => 'filterByStatus', 
        ];
    }


    // Validators

    public function hasCrew()
    {
        return ! is_null($this->crew_id) && is_a($this->crew, Crew::class);
    }

    public function hasInspector()
    {
        return ! empty($this->inspector_name);
    }

    public function isPendingStatus()
    {
        return self::validateIsPendingStatus([
            'scheduled_date' => $this->getRawOriginal('scheduled_date'),
        ]);
    }

    public function isPending()
    {
        return $this->status == 'pending';
    }

    public function isOnHold()
    {
        return $this->status == 'on hold';
    }

    public function isPassed()
    {
        return $this->status == 'passed';
    }

    public function isFailed()
    {
        return $this->status == 'failed';
    }


    // Scopes

    public function scopeWithRelationshipsForIndex($query)
    {
        return $query->with([
            'crew',
            'agency', 
            'work_order.job', 
            'work_order.client',
        ]);
    }

    public function scopeOnlyInspectorNames($query)
    {
        return $query
                ->select('inspector_name')
                ->distinct()
                ->get()
                ->pluck('inspector_name')
                ->filter();
    }


    // Filters

    public function scopeFilterByCrew($query, $crew_id)
    {
        return ! is_null($crew_id) ? $query->where('crew_id', $crew_id) : $query;
    }

    public function scopeFilterByAgency($query, $agency_id)
    {
        return ! is_null($agency_id) ? $query->where('agency_id', $agency_id) : $query;
    }


    // Relationships

    public function crew()
    {
        return $this->belongsTo(Crew::class);
    }

    public function agency()
    {
        return $this->belongsTo(Agency::class)->withTrashed();
    }


    // Statics

    public static function allStatuses()
    {
        return collect( self::$all_statuses );
    }

    public static function allStatusesForm()
    {
        return self::allStatuses()->reject(fn($status) => $status == 'pending');
    }

    public static function validateIsPendingStatus(array $values)
    {
        return ! empty( 
            array_filter($values, function ($value, $key) {
                return in_array($key, self::$attributes_for_pending_statuses) && empty($value);
            }, ARRAY_FILTER_USE_BOTH)
        );
    }
}
