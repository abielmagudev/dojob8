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

    public static $statuses_bscolors = [
        'pending' => 'text-bg-purple',
        'new' => 'text-bg-primary',
        'working' => 'text-bg-warning',
        'done' => 'text-bg-success animate__animated animate__pulse animate__infinite',
        'completed' => 'text-bg-success animate__animated animate__tada animate__infinite',
        'inspected' => 'text-bg-success',
        'closed' => 'text-bg-dark',
        'canceled' => 'text-bg-danger',
    ];

    public static $statuses = [
        'pending', // Pending of what?
        'new',
        'working', // started
        'done', // finished
        'completed', // Ready, reviewed, checked
        'inspected', // completed
        'closed',
        'canceled',
    ];

    public static $unfinished_statuses = [ // Not ready, unready, incomplete
        'pending',
        'new',
        'working',
        'done',
    ];

    public static $finished_statuses = [
        'completed',
        'inspected',
        'closed',
        'canceled',
    ];

    protected $fillable = [
        'status',
        'client_id',
        'contractor_id',
        'crew_id',
        'job_id',
        'notes',
        'scheduled_date',
        'working_at',
        'done_at',
        'completed_at',
        'closed_at',
    ];

    protected $casts = [
        'scheduled_date' => 'date',
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
            'status_group' => ['filterByStatusGroup'],
            'status' => 'filterByStatus',
        ];
    }


    // Attributes

    public function getStatusColorAttribute()
    {
        return self::getBsColorByStatus( $this->status );
    }


    // Validators

    public function hasCrew()
    {
        return (bool) $this->crew_id && $this->crew;
    }

    public function hasContractor()
    {
        return (bool) $this->contractor_id && is_a($this->contractor, Contractor::class);
    }

    public function hasMembers()
    {
        return (bool) $this->members_count || $this->members->count();
    }

    public function isFinished()
    {
        return self::getFinishedStatuses()->contains($this->status);
    }

    public function isUnfinished()
    {
        return self::getUnfinishedStatuses()->contains($this->status);
    }

    
    // Scopes

    public function scopeUnfinishedStatus($query)
    {
        return $query->whereIn('status', self::getUnfinishedStatuses()->all());
    }

    public function scopeWhereJobsAvailable($query)
    {
        $jobs_id = Job::all('id')->pluck('id')->toArray();
        
        return $query->whereIn('job_id', $jobs_id);
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

    public function scopeWhereContractorNull($query)
    {
        return $query->whereIsNull('contractor_id');
    }

    public function scopeWhereJob($query, $job_id)
    {
        return $query->where('job_id', $job_id);
    }


    // Filters

    public function scopeFilterByClient($query, $client_id)
    {
        if( is_null($client_id) ) {
            return $query;
        }

        return $query->whereClient($client_id);
    }

    public function scopeFilterByCrew($query, $crew_id)
    {
        if( is_null($crew_id) ) {
            return $query;
        }

        return $query->whereCrew($crew_id);
    }

    public function scopeFilterByContractor($query, $contractor_id)
    {
        if( is_null($contractor_id) ) {
            return $query;
        }

        if( $contractor_id == 0 ) {
            return $query->whereContractorNull();
        }

        return $query->whereContractor($contractor_id);
    }

    public function scopeFilterByJob($query, $job_id)
    {
        if( is_null($job_id) ) {
            return $query;
        }

        return $query->whereJob($job_id);
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

    public function inspections()
    {
        return $this->hasMany(Inspection::class);
    }

    public function members()
    {
        return $this->belongsToMany(Member::class)->using(MemberWorkOrder::class);
    }


    // Statics

    public static function getAllStatuses()
    {
        return collect(self::$statuses);
    }

    public static function getUnfinishedStatuses()
    {
        return collect(self::$unfinished_statuses);
    }

    public static function getFinishedStatuses()
    {
        return collect(self::$finished_statuses);
    }

    public static function isUnfinishedStatus(string $status)
    {
        return self::getUnfinishedStatuses()->contains($status);
    }

    public static function isFinishedStatus(string $status)
    {
        return self::getFinishedStatuses()->contains($status);
    }

    public static function filterByUnfinishedStatus(Collection $work_orders)
    {
        return $work_orders->filter(function ($wo) {
            return in_array($wo->status, self::getUnfinishedStatuses()->all());
        });
    }

    public static function getStatusesBsColors()
    {
        return collect( self::$statuses_bscolors );
    }

    public static function getBsColorByStatus(string $status)
    {
        return self::getStatusesBsColors()->get($status);
    }
}
