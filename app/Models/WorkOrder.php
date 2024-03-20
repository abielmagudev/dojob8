<?php

namespace App\Models;

use App\Models\Client\Traits\BelongsClient;
use App\Models\Contractor\Traits\BelongsContractor;
use App\Models\Crew\Traits\BelongsCrew;
use App\Models\History\Traits\HasHistory;
use App\Models\Inspection\Traits\HasInspections;
use App\Models\Kernel\Interfaces\FilterableQueryStringContract;
use App\Models\Kernel\Interfaces\PendingAttributesContract;
use App\Models\Kernel\Traits\BelongsCreatorUser;
use App\Models\Kernel\Traits\BelongsUpdaterUser;
use App\Models\Kernel\Traits\HasFilterableQueryStringContract;
use App\Models\Kernel\Traits\HasScheduledDate;
use App\Models\Kernel\Traits\HasStatus;
use App\Models\Kernel\Traits\PendingContractImplemented;
use App\Models\Media\Traits\HasMedia;
use App\Models\Payment\Traits\HasPayment;
use App\Models\Product\Traits\BelongsProducts;
use App\Models\WorkOrder\Kernel\WorkOrderStatusCatalog;
use App\Models\WorkOrder\Kernel\WorkOrderTypeCatalog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkOrder extends Model implements FilterableQueryStringContract, PendingAttributesContract
{
    use BelongsClient;
    use BelongsContractor;
    use BelongsCreatorUser;
    use BelongsUpdaterUser;
    use BelongsProducts;
    use BelongsCrew;
    use HasFactory;
    use HasFilterableQueryStringContract;
    use HasHistory;
    use HasInspections;
    use HasMedia;
    use HasPayment;
    use HasScheduledDate;
    use HasStatus;
    use PendingContractImplemented;

    protected $fillable = [
        'type',
        'rectification_id',
        'status',
        
        'scheduled_date',
        'ordered',
        'working_at',
        'working_id',
        'done_at',
        'done_id',
        'completed_at',
        'completed_id',

        'permit_code',
        'notes',

        'client_id',
        'job_id',
        'crew_id',
        'contractor_id',
        'assessment_id',
    ];

    protected $casts = [
        'scheduled_date' => 'date',
        'working_at' => 'datetime',
        'done_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    
    // Mutators

    public function setWorkingAtAttribute($value)
    {
        if(! empty($value) && $value <> $this->working_at )
        {
            $this->attributes['working_at'] = $value;
            $this->attributes['working_id'] = auth()->id();
            return;
        }

        $this->attributes['working_at'] = null;
        $this->attributes['working_id'] = null;
    }

    public function setDoneAtAttribute($value)
    {
        if(! empty($value) && $value <> $this->done_at )
        {
            $this->attributes['done_at'] = $value;
            $this->attributes['done_id'] = auth()->id();
            return;
        }

        $this->attributes['done_at'] = null;
        $this->attributes['done_id'] = null;
    }

    public function setCompletedAtAttribute($status)
    {        
        if( $status == 'completed' && is_null($this->completed_at) ) {
            $this->attributes['completed_at'] = now();
            $this->attributes['completed_id'] = auth()->id();
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


    // Validators

    public function isStandard()
    {
        return $this->type == 'standard' && is_null($this->rectification_id);
    }

    public function isRectification()
    {
        return ! $this->isStandard();
    }

    public function isRework()
    {
        return $this->type == 'rework' && is_int($this->rectification_id);
    }

    public function isWarranty()
    {
        return $this->type == 'warranty' && is_int($this->rectification_id);
    }

    public function hasIncompleteStatus()
    {
        return WorkOrderStatusCatalog::incomplete()->contains($this->status);
    }
    
    public function isCompleted()
    {
        return $this->status == 'completed' && $this->hasCompletedAt();
    }

    public function qualifiesForRectification()
    {
        return $this->isStandard() && $this->isCompleted();
    }

    public function qualifiesForInspection()
    {
        return $this->isCompleted();
    }

    public function hasPending(): bool
    {
        return is_null($this->scheduled_date) || is_null($this->crew_id);
    }

    public function hasNoPending(): bool
    {
        return ! $this->hasPending();
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


    // Relationships

    public function rectifications()
    {
        return $this->hasMany(self::class, 'rectification_id')->whereIn('type', WorkOrderTypeCatalog::rectification()->toArray());
    }

    public function reworks()
    {
        return $this->hasMany(self::class, 'rectification_id')->where('type', 'rework');
    }

    public function warranties()
    {
        return $this->hasMany(self::class, 'rectification_id')->where('type', 'warranty');
    }

    public function working_updater()
    {
        return $this->belongsTo(User::class, 'working_id')->withTrashed();
    }

    public function done_updater()
    {
        return $this->belongsTo(User::class, 'done_id')->withTrashed();
    }

    public function job()
    {
        return $this->belongsTo(Job::class)->withTrashed();
    }

    public function members()
    {
        return $this->belongsToMany(Member::class)->withTimestamps();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot([
            'quantity',
            'indications',
        ]);
    }


    // Scopes

    public function scopeSearch($query, $value, string $column = 'id')
    {
        return $query->where($column, 'like', "%{$value}%")->orderBy('id','asc');
    }

    public function scopeStandard($query)
    {
        return $query->where('type', 'standard')->whereNull('rectification_id');
    }

    public function scopeRectification($query)
    {
        return $query->whereIn('type', WorkOrderTypeCatalog::rectification()->toArray())->whereNotNull('rectification_id');
    }

    public function scopeRework($query)
    {
        return $query->whereIn('type', 'rework')->whereNotNull('rectification_id');
    }

    public function scopeWarranty($query)
    {
        return $query->where('type', 'warranty')->whereNotNull('rectification_id');
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

    public function scopePending($query)
    {
        return $query->whereNull('scheduled_date')->orWhereNull('crew_id');
    }

    public function scopeNoPending($query)
    {
        return $query->whereNotNull('scheduled_date')->WhereNotNull('crew_id');
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

    public function scopeFilterByJob($query, $value)
    {
        return ! is_null($value) ? $query->where('job_id', $value) : $query;
    }

    public function scopeFilterByTypeGroup($query, $types_group)
    {
        if( empty($types_group) || WorkOrderTypeCatalog::all()->diff($types_group)->isEmpty() ) {
            return $query;
        }

        if( WorkOrderTypeCatalog::rectification()->diff($types_group)->isEmpty() )
        {
            return $query->whereIn('type', WorkOrderTypeCatalog::rectification()->toArray());
        }

        if( in_array('rework', $types_group) ) {
            return $query->where('type', 'rework');
        }

        if( in_array('warranty', $types_group) ) {
            return $query->where('type', 'warranty');
        }

        return $query->where('type', 'standard');
    }

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
}
