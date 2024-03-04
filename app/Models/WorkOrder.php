<?php

namespace App\Models;

use App\Models\Crew\Traits\HasCrew;
use App\Models\Inspection\Traits\HasInspections;
use App\Models\Kernel\Interfaces\Filterable;
use App\Models\Kernel\Traits\HasFiltering;
use App\Models\Kernel\Traits\HasHookUsers;
use App\Models\Kernel\Traits\HasScheduledDate;
use App\Models\Kernel\Traits\HasStatus;
use App\Models\Payment\Traits\HasPayment;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkOrder extends Model implements Filterable
{
    // Framework
    use HasFactory;

    // Models
    use HasCrew;
    use HasInspections;
    use HasPayment;

    // Kernel
    use HasFiltering;
    use HasHookUsers;
    use HasScheduledDate;
    use HasStatus;

    const INITIAL_STATUS = 'new';

    protected $fillable = [
        'ordered',
        'status',

        'scheduled_date',
        'working_at',
        'working_by',
        'done_at',
        'done_by',
        'completed_at',
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



    // Interfaces
    
    public function getParameterFilterSettings(): array
    {
        return [
            'client' => 'filterByClient',
            'contractor' => 'filterByContractor',
            'crew' => 'filterByCrew', 
            'dates' => 'filterByScheduledDateBetween',
            'job' => 'filterByJob',
            'pending' => 'filterByPendingAttributes',
            'scheduled_date' => 'filterByScheduledDate',
            'search' => 'filterBySearch',
            'status_group' => 'filterByStatusGroup',
            'status' => 'filterByStatus',
            'type_group' => 'filterByTypeGroup',
        ];
    }



    // Mutators

    public function setWorkingAtAttribute($values)
    {
        if( is_array($values) ) {
            $values = trim( implode(' ', $values) );
        }

        if(! empty($values) && $values <> $this->working_at ) {
            $this->attributes['working_at'] = $values;
            $this->attributes['working_by'] = auth()->id();
        }
        
        if( empty($values) ) {
            $this->attributes['working_at'] = null;
            $this->attributes['working_by'] = null;
        }
    }

    public function setDoneAtAttribute($values)
    {
        if( is_array($values) ) {
            $values = trim( implode(' ', $values) );
        }

        if(! empty($values) && $values <> $this->done_at ) {
            $this->attributes['done_at'] = $values;
            $this->attributes['done_by'] = auth()->id();
        }
        
        if( empty($values) ) {
            $this->attributes['done_at'] = null;
            $this->attributes['done_by'] = null;
        }
    }

    public function setCompletedAtAttribute($status)
    {        
        if( $status == 'completed' && is_null($this->completed_at) ) {
            $this->attributes['completed_at'] = now();
            $this->attributes['completed_by'] = auth()->id();
        }
    }



    // Accessors

    public function getWorkingDateInputAttribute()
    {
        return ! is_null($this->working_at) ? Carbon::parse($this->working_at)->format('Y-m-d') : null;
    }

    public function getWorkingTimeInputAttribute()
    {
        return ! is_null($this->working_at) ? Carbon::parse($this->working_at)->format('H:i') : null;
    }

    public function getDoneDateInputAttribute()
    {
        return ! is_null($this->done_at) ? Carbon::parse($this->done_at)->format('Y-m-d') : null;
    }

    public function getDoneTimeInputAttribute()
    {
        return ! is_null($this->done_at) ? Carbon::parse($this->done_at)->format('H:i') : null;
    }

    public function getCompletedDateHumanAttribute()
    {
        return ! is_null($this->completed_at) ? Carbon::parse($this->completed_at)->format('d M, Y') : null;
    }

    public function getCompletedTimeHumanAttribute()
    {
        return ! is_null($this->completed_at) ? Carbon::parse($this->completed_at)->format('g:i A') : null;
    }

    public function getTypeAttribute()
    {
        if( $this->isRework() ) {
            return 'rework';
        }

        if( $this->isWarranty() ) {
            return 'warranty';
        }

        return 'standard';
    }

    public function getTypeIdAttribute()
    {
        return $this->rework_id ?? $this->warranty_id;
    }



    // Relationships

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
        return $this->belongsTo(Client::class)->withTrashed();
    }

    public function job()
    {
        return $this->belongsTo(Job::class)->withTrashed();
    }

    public function contractor()
    {
        return $this->belongsTo(Contractor::class)->withTrashed();
    }

    public function members()
    {
        return $this->belongsToMany(Member::class)->using(MemberWorkOrder::class)->withTimestamps();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function history()
    {
        return $this->morphMany(History::class, 'model');
    }

    public function working_updater()
    {
        return $this->belongsTo(User::class, 'working_by')->withTrashed();
    }

    public function done_updater()
    {
        return $this->belongsTo(User::class, 'done_by')->withTrashed();
    }



    // Actions

    public function attachWorkers()
    {
        $this->members()->attach( 
            $this->crew->members->pluck('id')
        );
    }



    // Scopes

    public function scopeSearch($query, $value, string $column = 'id')
    {
        return $query->where($column, 'like', "%{$value}%")->orderBy('id','asc');
    }

    public function scopePending($query)
    {
        return $query->whereNull('scheduled_date')->orWhereNull('crew_id');
    }

    public function scopeNotPending($query)
    {
        return $query->whereNotNull('scheduled_date')->WhereNotNull('crew_id');
    }

    public function scopeIncomplete($query, array $except = [])
    {         
        $incomplete_statuses = self::collectionIncompleteStatuses()->reject(function($status) use ($except) {
            return in_array($status, $except);
        })->toArray();

        return $query->whereIn('status', $incomplete_statuses);
    }

    public function scopeHasMembers($query, array $members_id)
    {
        return $query->whereHas('members', function($query) use ($members_id){
            $query->whereIn('member_id', $members_id);
        });
    }

    public function scopeHasMember($query, $member_id)
    {
        return $query->whereHas('members', function($query) use ($member_id){
            $query->where('member_id', $member_id);
        });
    }

    public function scopeWithAllRelationships($query)
    {
        return $query->with([
            // Catalog
            'client',
            'contractor',
            'crew',
            'job',
            'done_updater',
            'working_updater',
            
            // Operative
            'comments',
            'inspections',
            'reworks',
            'warranties',

            // Morph
            'files',
            'history',
            
            // Pivot
            'members',
        ]);
    }

    public function scopeWithEssentialRelationships($query)
    {
        return $query->with([
            'client',
            'contractor',
            'crew',
            'job',
        ]);
    }



    // Filters

    public function scopeFilterBySearch($query, $value)
    {
        return ! is_null($value) ? $query->search($value)->orderBy('id', 'asc') : $query;
    }

    public function scopeFilterByClient($query, $value)
    {
        return ! is_null($value) ? $query->where('client_id', $value) : $query;
    }

    public function scopeFilterByJob($query, $value)
    {
        return ! is_null($value) ? $query->where('job_id', $value) : $query;
    }

    public function scopeFilterByContractor($query, $value)
    {
        if( is_null($value) ) {
            return $query;
        }

        if( $value == 0 ) {
            return $query->whereNull('contractor_id');
        }

        return $query->where('contractor_id', $value);
    }

    public function scopeFilterByTypeGroup($query, $type_group)
    {
        if( empty($type_group) || count($type_group) == 3 ) {
            return $query;
        }

        if( count($type_group) == 2 && in_array('rework', $type_group) && in_array('warranty', $type_group) ) {
            return $query->whereNotNull('rework_id')->whereNotNull('warranty_id');
        }

        if( count($type_group) == 2 && in_array('rework', $type_group) &&! in_array('warranty', $type_group) ) {
            return $query->whereNull('warranty_id');
        }

        if( count($type_group) == 2 && in_array('warranty', $type_group) &&! in_array('rework', $type_group) ) {
            return $query->whereNull('rework_id');
        }

        if( count($type_group) == 1 && in_array('rework', $type_group) ) {
            return $query->whereNotNull('rework_id');
        }

        if( count($type_group) == 1 && in_array('warranty', $type_group) ) {
            return $query->whereNotNull('warranty_id');
        }

        return $query->whereNull('rework_id')->whereNull('warranty_id');
    }

    public function scopeFilterByPendingAttributes($query, $value)
    {
        if( is_null($value) ) {
            return $query;
        }

        if( $value == 0 ) {
            return $query->notPending();
        }

        return $query->pending();
    }



    // Validators

    public function hasContractor()
    {
        return ! is_null($this->contractor_id);
    }

    public function hasContractorVerified()
    {
        return ! is_null($this->contractor_id) && is_a($this->contractor, Contractor::class);
    }

    public function hasPending()
    {
        return is_null($this->scheduled_date) || is_null($this->crew_id);
    }

    public function hasIncompleteStatus()
    {
        return self::collectionIncompleteStatuses()->contains($this->status);
    }

    public function hasWorkingAt()
    {
        return ! empty( $this->working_at );
    }

    public function hasDoneAt()
    {
        return ! empty( $this->done_at );
    }

    public function hasCompletedAt()
    {
        return ! empty( $this->completed_at );
    }
    
    public function isCompleted()
    {
        return $this->status == 'completed' && $this->hasCompletedAt();
    }

    public function isRework()
    {
        return is_int($this->rework_id);
    }

    public function isWarranty()
    {
        return is_int($this->warranty_id);
    }

    public function isStandard()
    {
        return ! $this->isRework() && ! $this->isWarranty();
    }

    public function isNonstandard()
    {
        return $this->isRework() || $this->isWarranty();
    }

    public function qualifiesForRectification()
    {
        return $this->isStandard() && $this->isCompleted();
    }

    public function qualifiesForInspection()
    {
        return $this->isCompleted();
    }



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
