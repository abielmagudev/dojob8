<?php

namespace App\Models;

use App\Models\Crew\Traits\HasCrew;
use App\Models\Kernel\Interfaces\FilterableQueryStringContract;
use App\Models\Kernel\Traits\HasFilterableQueryStringContract;
use App\Models\Kernel\Traits\HasHookUsers;
use App\Models\Kernel\Traits\HasScheduledDate;
use App\Models\Kernel\Traits\HasStatus;
use App\Models\Kernel\Traits\HelpForPending;
use App\Models\Media\Traits\HasMedia;
use App\Models\WorkOrder\Traits\BelongWorkOrder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Inspection extends Model implements FilterableQueryStringContract
{
    // Framework
    use HasFactory;
    
    // Kernel
    use HasFilterableQueryStringContract;
    use HasHookUsers;
    use HasScheduledDate;
    use HasStatus;
    use HelpForPending;
    
    // Models
    use BelongWorkOrder;
    use HasCrew;
    use HasMedia;

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


    // Interface 

    public function getMappingFilterableQueryString(): array
    {
        return [
            'agency' => 'filterByAgency',
            'crew' => 'filterByCrew',
            'dates' => 'filterByScheduledDateBetween',
            'pending' => 'filterByPending',
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

    public function members()
    {
        return $this->belongsToMany(Member::class)->using(InspectionMember::class)->withTimestamps();
    }
 

    // Validators

    public function hasPending()
    {
        return is_null( $this->scheduled_date );
    }

    public function hasNoPending()
    {
        return ! $this->hasPending();
    }

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

    public function scopePending($query)
    {
        return $query->whereNull('scheduled_date');
    }

    public function scopeNoPending($query)
    {
        return $query->whereNotNull('scheduled_date');
    }


    // Filters

    public function scopeFilterByAgency($query, $value)
    {
        if( empty($value) ) {
            return $query;
        }

        return $query->where('agency_id', $value);
    }
}
