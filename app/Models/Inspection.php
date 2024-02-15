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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
        'awaiting',
        'approved',
        'failed',
        'pending',
    ];

    public static $attributes_for_pending_statuses = [
        'scheduled_date',
    ];

    
    // Interface

    public function getParameterFilterSettings(): array
    {
        return [
            'agency' => 'filterByAgency',
            'crew' => 'filterByCrew',
            'dates' => 'filterByScheduledDateBetween',
            'scheduled_date' => 'filterByScheduledDate',
            'status_group' => 'filterByStatusGroup',
            'status' => 'filterByStatus', 
        ];
    }


    // Mutators

    public function setInspectorNameAttribute($value)
    {
        $this->attributes['inspector_name'] = Str::title($value);
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

    public function isPending()
    {
        return $this->status == 'pending';
    }

    public function isAwaiting()
    {
        return $this->status == 'awaiting';
    }

    public function isApproved()
    {
        return $this->status == 'approved';
    }

    public function isFailed()
    {
        return $this->status == 'failed';
    }

    public function qualifiesPendingStatus()
    {
        return self::qualifyPendingStatus( $this->getAttributes() );
    }


    // Scopes

    public function scopeWithRelationshipsForIndex($query)
    {
        return $query->with([
            'agency', 
            'crew',
            'work_order.client',
            'work_order.job', 
        ]);
    }

    public function scopeOnlyInspectorNames($query)
    {
        return $query->select('inspector_name')
                     ->distinct()
                     ->get()
                     ->pluck('inspector_name')
                     ->filter();
    }

    public function scopeNoPendingStatus($query)
    {
        return $query->where('status', '!=', 'pending');
    }

    public function scopePendingStatusCount($query)
    {
        return $query->select( DB::raw('COUNT(*) as count') )
                     ->where('status', 'pending')
                     ->first()
                     ->count;
    }

    public function scopeAwaitingStatusCount($query)
    {
        return $query->select( DB::raw('COUNT(*) as count') )
                     ->where('status', 'awaiting')
                     ->first()
                     ->count;
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

    public function members()
    {
        return $this->belongsToMany(Member::class)->using(InspectionMember::class)->withTimestamps();
    }

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
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

    public static function qualifyPendingStatus(array $values)
    {
        $result = array_filter($values, function ($value, $key) {
            return in_array($key, self::$attributes_for_pending_statuses) && empty($value);
        }, ARRAY_FILTER_USE_BOTH);

        return count($result) > 0;
    }

    public static function generateByWorkOrderSetup(WorkOrder $work_order)
    {
        $created = [];

        foreach($work_order->job->inspections_setup->all() as $setting)
        {
            $inspection = self::create([
                'agency_id' => $setting['agency'],
                'work_order_id' => $work_order->id,
                'status' => 'pending',
            ]);

            array_push($created, $inspection);
        }
        
        return $created;
    }
}
