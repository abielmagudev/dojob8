<?php

namespace App\Models;

use App\Models\Crew\Traits\HasCrew;
use App\Models\Kernel\Interfaces\Filterable;
use App\Models\Kernel\Traits\HasFiltering;
use App\Models\Kernel\Traits\HasHookUsers;
use App\Models\Kernel\Traits\HasPendingAttributes;
use App\Models\Kernel\Traits\HasScheduledDate;
use App\Models\Kernel\Traits\HasStatus;
use App\Models\WorkOrder\Associated\BelongWorkOrderTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Inspection extends Model implements Filterable
{
    use HasFactory;
    
    use BelongWorkOrderTrait;
    use HasCrew;
    use HasFiltering;
    use HasHookUsers;
    use HasPendingAttributes;
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
        'failed',
        'success',
    ];

    public static $pending_attributes = [
        'scheduled_date',
    ];



    // Interface 

    public function getParameterFilterSettings(): array
    {
        return [
            'agency' => 'filterByAgency',
            'crew' => 'filterByCrew',
            'dates' => 'filterByScheduledDateBetween',
            'pending' => 'filterByPendingAttributes',
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



    // Relationships

    public function agency()
    {
        return $this->belongsTo(Agency::class)->withTrashed();
    }

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function members()
    {
        return $this->belongsToMany(Member::class)->using(InspectionMember::class)->withTimestamps();
    }
 


    // Validators

    public function hasInspector()
    {
        return ! empty($this->inspector_name);
    }

    public function isAwaiting()
    {
        return $this->status == 'awaiting';
    }

    public function isFailed()
    {
        return $this->status == 'failed';
    }
    
    public function isSuccess()
    {
        return $this->status == 'success';
    }


    // Scopes

    public function scopeWithEssentialRelationships($query)
    {
        return $query->with([
            'agency', 
            'crew',
            'work_order',
        ]);
    }

    public function scopeWithNestedRelationships($query)
    {
        return $query->with([
            'work_order.client',
            'work_order.job',
        ]);
    }

    public function scopeAwaitingStatusCount($query)
    {
        return $query->select( DB::raw('COUNT(*) as awaiting_status_count') )->where('status', 'awaiting');
    }

    public function scopeInspectorNames($query)
    {
        return $query->select('inspector_name')->distinct()->whereNotNull('inspector_name');
    }



    // Filters

    public function scopeFilterByAgency($query, $value)
    {
        if( empty($value) ) {
            return $query;
        }

        return $query->where('agency_id', $value);
    }



    // Statics

    public static function collectionAllStatuses()
    {
        return collect(self::$all_statuses);
    }
}
