<?php

namespace App\Models;

use App\Models\Crew\Traits\HasCrew;
use App\Models\Inspection\Traits\HasInspections;
use App\Models\Kernel\Interfaces\FilterableQueryStringContract;
use App\Models\Kernel\Traits\HasFilterableQueryStringContract;
use App\Models\Kernel\Traits\HasHookUsers;
use App\Models\Kernel\Traits\HasScheduledDate;
use App\Models\Kernel\Traits\HasStatus;
use App\Models\Media\Traits\HasMedia;
use App\Models\Payment\Traits\HasPayment;
use App\Models\WorkOrder\Kernel\WorkOrderStatusCatalog;
use App\Models\WorkOrder\Kernel\WorkOrderTypeCatalog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkOrder extends Model implements FilterableQueryStringContract
{
    // Framework
    use HasFactory;

    // Kernel
    use HasFilterableQueryStringContract;
    use HasHookUsers;
    use HasScheduledDate;
    use HasStatus;

    // Models
    use HasCrew;
    use HasInspections;
    use HasPayment;
    use HasMedia;

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
        'permit_code',
        'notes',

        'rectification_type',
        'rectification_id',
        'client_id',
        'contractor_id',
        'crew_id',
        'job_id',
        'assessment_id',
    ];

    protected $casts = [
        'scheduled_date' => 'date',
        'working_at' => 'datetime',
        'done_at' => 'datetime',
        'completed_at' => 'datetime',
    ];



    // Interfaces
    
    public function getMappingFilterableQueryString(): array
    {
        return [
            'client' => 'filterByClient',
            'contractor' => 'filterByContractor',
            'crew' => 'filterByCrew', 
            'dates' => 'filterByScheduledDateBetween',
            'job' => 'filterByJob',
            'pending' => 'filterByPending',
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
        return ! is_null($this->working_at) ? $this->working_at->format('Y-m-d') : null;
    }

    public function getWorkingTimeInputAttribute()
    {
        return ! is_null($this->working_at) ? $this->working_at->format('H:i') : null;
    }

    public function getDoneDateInputAttribute()
    {
        return ! is_null($this->done_at) ? $this->done_at->format('Y-m-d') : null;
    }

    public function getDoneTimeInputAttribute()
    {
        return ! is_null($this->done_at) ? $this->done_at->format('H:i') : null;
    }

    public function getCompletedDateHumanAttribute()
    {
        return ! is_null($this->completed_at) ? $this->completed_at->format('d M, Y') : null;
    }

    public function getCompletedTimeHumanAttribute()
    {
        return ! is_null($this->completed_at) ? $this->completed_at->format('g:i A') : null;
    }

    public function getTypeAttribute()
    {
        if( empty($this->rectification_type) ) {
            return 'standard';
        }

        return $this->rectification_type;
    }

    public function getTypeIdAttribute()
    {
        return $this->rectification_id;
    }



    // Relationships

    public function reworks()
    {
        return $this->hasMany(self::class, 'rectification_id')->where('rectification_type', 'rework');
    }

    public function warranties()
    {
        return $this->hasMany(self::class, 'rectification_id')->where('rectification_type', 'warranty');
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

    public function scopeNoPending($query)
    {
        return $query->whereNotNull('scheduled_date')->WhereNotNull('crew_id');
    }

    public function scopeIncomplete($query, array $except = [])
    {         
        $incomplete_statuses = WorkOrderStatusCatalog::incomplete()->reject(function($status) use ($except) {
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

    public function scopeFilterByTypeGroup($query, $types_group)
    {
        if( empty($types_group) || WorkOrderTypeCatalog::all()->diff($types_group)->isEmpty() ) {
            return $query;
        }

        if( WorkOrderTypeCatalog::rectification()->diff($types_group)->isEmpty() )
        {
            return $query->whereNotNull('rectification_type');
        }

        if( in_array('rework', $types_group) ) {
            return $query->where('rectification_type', 'rework');
        }

        if( in_array('warranty', $types_group) ) {
            return $query->where('rectification_type', 'warranty');
        }

        return $query->whereNull('rectification_type');
    }

    public function scopeFilterByPending($query, $value)
    {
        if( is_null($value) ) {
            return $query;
        }

        if( $value == 0 ) {
            return $query->noPending();
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
        return WorkOrderStatusCatalog::incomplete()->contains($this->status);
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
        return $this->rectification_type == 'rework' && is_int($this->rectification_id);
    }

    public function isWarranty()
    {
        return $this->rectification_type == 'warranty' && is_int($this->rectification_id);
    }

    public function isStandard()
    {
        return is_null($this->rectification_type) && is_null($this->rectification_id);
    }

    public function isNonStandard()
    {
        return ! $this->isStandard();
    }

    public function qualifiesForRectification()
    {
        return $this->isStandard() && $this->isCompleted();
    }

    public function qualifiesForInspection()
    {
        return $this->isCompleted();
    }
}
