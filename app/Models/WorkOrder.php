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
        'completed'
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
            'scheduled_date' => 'filterByScheduledDate',
            'status_group' => 'filterByStatusGroup',
            'status' => 'filterByStatus',
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


    // Validators

    public function hasContractor()
    {
        return (bool) $this->contractor_id && is_a($this->contractor, Contractor::class);
    }

    public function hasMembers()
    {
        return (bool) $this->members_count || $this->members->count();
    }

    public function hasReworks()
    {
        return (bool) $this->reworks_count || $this->reworks->count();
    }

    public function hasWarranties()
    {
        return (bool) $this->warranties_count || $this->members->count();
    }

    public function isIncomplete()
    {
        return self::inIncompleteStatuses($this->status);
    }

    public function isCompleted()
    {
        return ! self::inIncompleteStatuses($this->status);
    }

    public function isRework()
    {
        return ! is_null($this->rework_id) && is_a($this->rework, self::class);
    }

    public function isWarranty()
    {
        return ! is_null($this->warranty_id) && is_a($this->warranty, self::class);
    }

    public function isDefault()
    {
        return ! $this->isRework() &&! $this->isWarranty();
    }

    public function qualifiesForRework()
    {
        return $this->isDefault() && self::inReworkStatuses($this->status);
    }

    public function qualifiesForWarranty()
    {
        return $this->isDefault() && self::inWarrantyStatuses($this->status);
    }
    

    // Scopes

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

    public function scopeWhereInRework($query, array $values)
    {
        return $query->whereIn('rework_id', $values);
    }

    public function scopeWhereInWarranty($query, array $values)
    {
        return $query->whereIn('warranty_id', $values);
    }

    public function scopeWhereRework($query, $value)
    {
        return $query->where('rework_id', $value);
    }

    public function scopeWhereWarranty($query, $value)
    {
        return $query->where('warranty_id', $value);
    }

    public function scopeWhereNullRework($query)
    {
        return $query->whereNull('rework_id');
    }

    public function scopeWhereNullWarranty($query)
    {
        return $query->whereNull('warranty_id');
    }

    public function scopeWhereNotNullRework($query)
    {
        return $query->whereNotNull('rework_id');
    }

    public function scopeWhereNotNullWarranty($query)
    {
        return $query->whereNotNull('warranty_id');
    }


    // Filters

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

    public function rework()
    {
        return $this->belongsTo(self::class, 'id', 'rework_id');
    }

    public function warranty()
    {
        return $this->belongsTo(self::class, 'id', 'warranty_id');
    }

    public function members()
    {
        return $this->belongsToMany(Member::class)->using(MemberWorkOrder::class);
    }

    public function inspections()
    {
        return $this->hasMany(Inspection::class);
    }

    public function reworks()
    {
        return $this->hasMany(self::class, 'rework_id');
    }

    public function warranties()
    {
        return $this->hasMany(self::class, 'warranty_id');
    }


    // Statics

    public static function getAllTypes()
    {
        return collect( self::$all_types );
    }

    public static function getTypesNonDefault()
    {
        return self::getAllTypes()->filter(fn($value) => $value <> 'default');
    }

    public static function getAllStatuses()
    {
        return collect(self::$all_statuses);
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

    public static function filterByIncompleteStatuses(Collection $work_orders)
    {
        return $work_orders->filter(function ($wo) {
            return self::inIncompleteStatuses($wo->status);
        });
    }

    public static function inIncompleteStatuses(string $status)
    {
        return in_array($status, self::$incomplete_statuses);
    }

    public static function inReworkStatuses(string $status)
    {
        return in_array($status, self::$rework_statuses);
    }

    public static function inWarrantyStatuses(string $status)
    {
        return in_array($status, self::$warranty_statuses);
    }

    public static function inArchivedStatuses(string $status)
    {
        return in_array($status, self::$archived_statuses);
    }

    public static function inCrewStatuses(string $status)
    {
        return in_array($status, self::$crew_statuses);
    }
}
