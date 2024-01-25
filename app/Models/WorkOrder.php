<?php

namespace App\Models;

use App\Models\Kernel\FilteringInterface;
use App\Models\Kernel\HasFilteringTrait;
use App\Models\Kernel\HasHookUsersTrait;
use App\Models\Kernel\HasScheduledDateTrait;
use App\Models\Kernel\HasStatusTrait;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkOrder extends Model implements FilteringInterface
{
    use HasFactory;
    use HasFilteringTrait;
    use HasHookUsersTrait;
    use HasScheduledDateTrait;
    use HasStatusTrait;

    const INITIAL_STATUS = 'new';

    protected $fillable = [
        'status',
        'scheduled_date',
        'rework_id',
        'warranty_id',
        'client_id',
        'contractor_id',
        'crew_id',
        'job_id',
        'working_at',
        'done_at',
        'completed_at',
        'archived_at',
        'permit_code',
        'notes',
    ];

    protected $casts = [
        'scheduled_date' => 'date',
    ];

    public static $all_types = [
        'default',
        'rework',
        'warranty',
    ];

    public static $all_statuses = [
        'pending',
        'new',
        'working',
        'done',
        'completed',
        'inspected',
        'closed',
        'canceled',
        'denialed',
    ];

    public static $incomplete_statuses = [ 
        'pending',
        'new',
        'working',
        'done',
    ];

    public static $archived_statuses = [ 
        'closed',
        'canceled',
        'denialed',
    ];

    public static $rework_statuses = [
        'completed',
        'inspected',
    ];

    public static $warranty_statuses = [
        'closed',
    ];

    public static $crew_statuses = [
        'working',
        'done',
    ];


    // Interface

    public function inputFilterSettings(): array
    {
        return [
            'client' => 'filterByClient',
            'contractor' => 'filterByContractor',
            'crew' => 'filterByCrew',
            'job' => 'filterByJob',
            'dates' => 'filterByScheduledDateBetween',
            'search' => 'filterBySearch',
            'scheduled_date' => 'filterByScheduledDate',
            'status_group' => 'filterByStatusGroup',
            'status' => 'filterByStatus',
            'type_group' => 'filterByTypeGroup',
        ];
    }


    // Attributes

    public function getTypeAttribute()
    {
        if( $this->isRework() ) {
            return 'rework';
        }

        if( $this->isWarranty() ) {
            return 'warranty';
        }

        return 'default';
    }

    public function getBoundIdAttribute()
    {
        return $this->rework_id ?? $this->warranty_id;
    }

    public function getBoundAttribute()
    {
        return $this->isRework() ? $this->rework : $this->warranty;
    }


    // Validators

    public function isRework()
    {
        return ! is_null($this->rework_id) && is_a($this->rework, self::class);
    }

    public function isWarranty()
    {
        return ! is_null($this->warranty_id) && is_a($this->warranty, self::class);
    }

    public function isBound()
    {
        return $this->isRework() || $this->isWarranty();
    }

    public function isDefault()
    {
        return ! $this->isRework() &&! $this->isWarranty();
    }

    public function isType(string $type)
    {
        return $this->type == $type;
    }

    public function qualifiesForRework()
    {
        return $this->isDefault() && self::inReworkStatuses($this->status);
    }

    public function qualifiesForWarranty()
    {
        return $this->isDefault() && self::inWarrantyStatuses($this->status);
    }

    public function qualifiesToBind()
    {
        return $this->qualifiesForRework() || $this->qualifiesForWarranty();
    }
    
    public function isIncomplete()
    {
        return self::inIncompleteStatuses($this->status);
    }

    public function isCompleted()
    {
        return ! self::inIncompleteStatuses($this->status);
    }

    public function hasReworks()
    {
        return (bool) $this->reworks_count || $this->reworks->count();
    }

    public function hasWarranties()
    {
        return (bool) $this->warranties_count || $this->members->count();
    }

    public function hasMembers()
    {
        return (bool) $this->members_count || $this->members->count();
    }

    public function hasCrew()
    {
        return ! is_null($this->crew_id) && is_a($this->crew, Crew::class);
    }
    
    public function hasContractor()
    {
        return (bool) $this->contractor_id && is_a($this->contractor, Contractor::class);
    }

    public function hasPermitCode()
    {
        return $this->permit_code <> null && $this->permit_code <> '';
    }


    // Scopes

    public function scopeWhereId($query, $value)
    {
        return $query->where('id', $value);
    }

    public function scopeWhereSearch($query, $value, string $column = 'id')
    {
        return $query->where($column, 'like', "%{$value}%");
    }

    public function scopeWhereRework($query, $value)
    {
        return $query->where('rework_id', $value);
    }

    public function scopeWhereReworkNull($query, bool $strict = true)
    {
        return $strict ? $query->whereNull('rework_id') : $query->orWhereNull('rework_id');
    }

    public function scopeWhereReworkNotNull($query, bool $strict = true)
    {
        return $strict ? $query->whereNotNull('rework_id') : $query->orWhereNotNull('rework_id');
    }

    public function scopeWhereInRework($query, array $values)
    {
        return $query->whereIn('rework_id', $values);
    }

    public function scopeWhereWarranty($query, $value)
    {
        return $query->where('warranty_id', $value);
    }

    public function scopeWhereWarrantyNull($query, bool $strict = true)
    {
        return $strict ? $query->whereNull('warranty_id') : $query->orWhereNotNull('warranty_id');
    }

    public function scopeWhereWarrantyNotNull($query, bool $strict = true)
    {
        return $strict ? $query->whereNotNull('warranty_id'): $query->orWhereNotNull('warranty_id');
    }

    public function scopeWhereInWarranty($query, array $values)
    {
        return $query->whereIn('warranty_id', $values);
    }

    public function scopeIncompleteStatus($query)
    {
        return $query->whereIn('status', self::getIncompleteStatuses()->all());
    }

    public function scopeWhereClient($query, $client_id)
    {
        return $query->where('client_id', $client_id);
    }

    public function scopeWhereCrew($query, $crew_id)
    {
        return $query->where('crew_id', $crew_id);
    }

    public function scopeWhereContractor($query, $contractor_id)
    {
        return $query->where('contractor_id', $contractor_id);
    }

    public function scopeWhereNotContractor($query)
    {
        return $query->whereIsNull('contractor_id');
    }

    public function scopeWhereJob($query, $job_id)
    {
        return $query->where('job_id', $job_id);
    }

    public function scopeWhereJobsAvailable($query)
    {
        $jobs_id = Job::all('id')->pluck('id')->toArray();
        
        return $query->whereIn('job_id', $jobs_id);
    }

    public function scopeWherePermitCode($query, $value)
    {
        return $query->where('permit_code', $value);
    }

    public function scopeWherePermitCodeLike($query, $value)
    {
        return $query->where('permit_code', 'like', $value);
    }


    // Filters

    public function scopeFilterBySearch($query, $value)
    {
        return ! is_null($value) ? $query->whereId($value) : $query;
    }

    public function scopeFilterByClient($query, $client_id)
    {
        return ! is_null($client_id) ? $query->whereClient($client_id) : $query;
    }

    public function scopeFilterByCrew($query, $crew_id)
    {
        return ! is_null($crew_id) ? $query->whereCrew($crew_id) : $query;
    }

    public function scopeFilterByJob($query, $job_id)
    {
        return ! is_null($job_id) ? $query->whereJob($job_id) : $query;
    }

    public function scopeFilterByContractor($query, $contractor_id)
    {
        if( is_null($contractor_id) ) {
            return $query;
        }

        if( $contractor_id == 0 ) {
            return $query->whereNotContractor();
        }

        return $query->whereContractor($contractor_id);
    }

    public function scopeFilterByTypeGroup($query, $type_group)
    {
        if( empty($type_group) || count($type_group) == 3 ) {
            return $query;
        }

        if( count($type_group) == 2 && in_array('rework', $type_group) && in_array('warranty', $type_group) ) {
            return $query->whereReworkNotNull(false)->whereWarrantyNotNull(false);
        }

        if( count($type_group) == 2 && in_array('rework', $type_group) &&! in_array('warranty', $type_group) ) {
            return $query->whereWarrantyNull();
        }

        if( count($type_group) == 2 && in_array('warranty', $type_group) &&! in_array('rework', $type_group) ) {
            return $query->whereReworkNull();
        }

        if( count($type_group) == 1 && in_array('rework', $type_group) ) {
            return $query->whereReworkNotNull();
        }

        if( count($type_group) == 1 && in_array('warranty', $type_group) ) {
            return $query->whereWarrantyNotNull();
        }

        return $query->whereReworkNull()->whereWarrantyNull();
    }

    public function scopeWithBasicRelationships($query)
    {
        return $query->with([
            'client',
            'contractor',
            'crew',
            'job',
        ]);
    }

    public function scopeWithAllRelationships($query)
    {
        return $query->with([
            'client',
            'contractor',
            'crew',
            'job',
            'rework',
            'warranty',
            'reworks',
            'warranties',
        ]);
    }


    // Relations


    public function rework()
    {
        return $this->belongsTo(self::class, 'rework_id');
    }

    public function warranty()
    {
        return $this->belongsTo(self::class, 'warranty_id');
    }

    public function reworks()
    {
        return $this->hasMany(self::class, 'rework_id');
    }

    public function warranties()
    {
        return $this->hasMany(self::class, 'warranty_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function crew()
    {
        return $this->belongsTo(Crew::class);
    }

    public function contractor()
    {
        return $this->belongsTo(Contractor::class);
    }

    public function members()
    {
        return $this->belongsToMany(Member::class)->using(MemberWorkOrder::class);
    }

    public function inspections()
    {
        return $this->hasMany(Inspection::class);
    }


    // Statics

    public static function getAllTypes()
    {
        return collect( self::$all_types );
    }

    public static function getAllStatuses()
    {
        return collect(self::$all_statuses);
    }

    public static function getNonDefaultTypes()
    {
        return self::getAllTypes()->filter(fn($value) => $value <> 'default');
    }

    public static function getReworkStatuses()
    {
        return collect( self::$rework_statuses );
    }

    public static function getWarrantyStatuses()
    {
        return collect( self::$warranty_statuses );
    }
    
    public static function inNonDefaultTypes(string $status)
    {
        return self::getNonDefaultTypes()->contains($status);
    }

    public static function inReworkStatuses(string $status)
    {
        return in_array($status, self::$rework_statuses);
    }

    public static function inWarrantyStatuses(string $status)
    {
        return in_array($status, self::$warranty_statuses);
    }

    public static function getIncompleteStatuses()
    {
        return collect(self::$incomplete_statuses);
    }

    public static function getCompletedStatuses()
    {
        return self::getAllStatuses()->diff(
            self::getIncompleteStatuses()->toArray()
        );
    }

    public static function inCrewStatuses(string $status)
    {
        return in_array($status, self::$crew_statuses);
    }
    
    public static function inArchivedStatuses(string $status)
    {
        return in_array($status, self::$archived_statuses);
    }

    public static function inIncompleteStatuses(string $status)
    {
        return in_array($status, self::$incomplete_statuses);
    }

    public static function filterCollectionByIncompleteStatuses(Collection $work_orders)
    {
        return $work_orders->filter(function ($wo) {
            return self::inIncompleteStatuses($wo->status);
        });
    }
}
