<?php

namespace App\Models;

use App\Models\Kernel\HasActionsByRequestTrait;
use App\Models\Kernel\HasBeforeAfterTrait;
use App\Models\Kernel\HasHookUsersTrait;
use App\Models\Kernel\HasModelHelpersTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class WorkOrder extends Model
{
    use HasActionsByRequestTrait;
    use HasBeforeAfterTrait;
    use HasFactory;
    use HasHookUsersTrait;
    use HasModelHelpersTrait;

    const FIRST_STATUS_WHEN_CREATED = 'new';

    public static $statuses_bscolors = [
        'pending' => 'text-bg-purple',
        'new' => 'text-bg-primary',
        'working' => 'text-bg-warning',
        'done' => 'text-bg-success animate__animated animate__pulse animate__infinite',
        'completed' => 'text-bg-success animate__animated animate__tada animate__infinite',
        'inspected' => 'text-bg-success',
        'closed' => 'text-bg-dark',
        'denialed' => 'text-bg-danger',
        'canceled' => 'text-bg-danger',
    ];

    public static $all_statuses = [
        'pending',
        'new',
        'working',
        'done',
        'completed',
        'inspected',
        'closed',
        'denialed',
        'canceled',
    ];

    public static $unfinished_statuses = [
        'pending',
        'new',
        'working',
        'done',
    ];

    public static $inputs_filters = [
        'client' => 'filterByClient',
        'crew' => 'filterByCrew',
        'contractor' => 'filterByContractor',
        'job' => 'filterByJob',
        'status' => 'filterByStatus',
        'scheduled_date' => 'filterByScheduledDate',
        'scheduled_date_range' => 'filterByScheduledDateRange',
        'status_rule' => ['filterByStatusRule', 'status_group'],
    ];

    protected $fillable = [
        'client_id',
        'crew_id',
        'contractor_id',
        'job_id',
        'notes',
        'scheduled_date',
        'scheduled_time',
    ];

    protected $casts = [
        'scheduled_date' => 'date',
    ];



    // Attributes

    public function getStatusColorAttribute()
    {
        return self::getBsColorByStatus( $this->status );
    }

    public function getScheduledDateInputAttribute()
    {
        return $this->id ? $this->scheduled_date->format('Y-m-d') : null;
    }

    public function getScheduledTimeInputAttribute()
    {
        return $this->getRawOriginal('scheduled_time') ? Carbon::parse($this->scheduled_time)->format('H:i') : null;
    }

    public function getScheduledDatetimeAttribute()
    {
        return $this->id ? "{$this->scheduled_date} {$this->scheduled_time}" : null;
    }

    public function getScheduledDateHumanAttribute()
    {
        return $this->id ? $this->scheduled_date->format('D M d, Y') : null;
    }

    public function getScheduledTimeHumanAttribute()
    {
        return $this->getRawOriginal('scheduled_time') ? Carbon::parse($this->scheduled_time)->format('h:i A') : null;
    }

    public function getScheduledDatetimeHumanAttribute()
    {
        return $this->id ? $this->scheduled_date->toDayDateTimeString() : null;
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

    public function scopeWhereStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeWhereStatusIn($query, array $status_array)
    {
        return $query->whereIn('status', $status_array);
    }

    public function scopeWhereStatusNotIn($query, array $status_array)
    {
        return $query->whereNotIn('status', $status_array);
    }

    public function scopeWhereScheduledDateFrom($query, $scheduled_date_from)
    {
        return $query->where('scheduled_date', '>=', $scheduled_date_from);
    }

    public function scopeWhereScheduledDateTo($query, $scheduled_date_to)
    {
        return $query->where('scheduled_date', '<=', $scheduled_date_to);
    }

    public function scopeWhereScheduledDateBetween($query, $scheduled_date_ranges)
    {
        return $query->whereBetween('scheduled_date', $scheduled_date_ranges);
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

    public function scopeFilterByStatus($query, $status)
    {
        if( is_null($status) ) {
            return $query;
        }

        return $query->whereStatus($status);
    }

    public function scopeFilterByStatusRule($query, $status_rule, $status_group = [])
    {
        if(! in_array($status_rule, ['except', 'only']) ||! is_array($status_group) || empty($status_group) ) {
            return $query;
        }

        if( $status_rule == 'except' ) {
            return $query->whereStatusNotIn($status_group);
        }

        return $query->whereStatusIn($status_group);
    }

    public function scopeFilterByScheduledDate($query, $scheduled_date)
    {
        if( is_null($scheduled_date) ) {
            return $query;
        }

        return $query->whereScheduledDate($scheduled_date);
    }

    public function scopeFilterByScheduledDateRange($query, $scheduled_date_range)
    {
        if(! isset($scheduled_date_range[0]) &&! isset($scheduled_date_range[1]) ) {
            return $query;
        }

        if( isset($scheduled_date_range[0]) &&! isset($scheduled_date_range[1]) ) {
            return $query->whereScheduledDateFrom($scheduled_date_range[0]);
        }
        
        if(! isset($scheduled_date_range[0]) && isset($scheduled_date_range[1]) ) {
            return $query->whereScheduledDateTo($scheduled_date_range[1]);
        }

        return $query->whereScheduledDateBetween($scheduled_date_range);
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



    // Statics

    public static function getAllStatuses()
    {
        return collect(self::$all_statuses);
    }

    public static function getUnfinishedStatuses()
    {
        return collect(self::$unfinished_statuses);
    }

    public static function generateUrlUnfinishedStatus(array $parameters = [])
    {
        $arguments = array_merge($parameters, [
            'status_rule' => 'only',
            'status_group' => self::getUnfinishedStatuses()->all(),
        ]);

        return route('work-orders.index', $arguments);
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
