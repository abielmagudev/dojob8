<?php

namespace App\Models;

use App\Models\Client\Traits\BelongsClient;
use App\Models\Contractor\Traits\BelongsContractor;
use App\Models\Crew\Traits\BelongsCrew;
use App\Models\History\Traits\HasHistory;
use App\Models\Kernel\Interfaces\FilterableQueryStringContract;
use App\Models\Kernel\Interfaces\PendingAttributesContract;
use App\Models\Kernel\Traits\BelongsCreatorUser;
use App\Models\Kernel\Traits\BelongsUpdaterUser;
use App\Models\Kernel\Traits\HasFilterableQueryStringContract;
use App\Models\Kernel\Traits\HasScheduledDate;
use App\Models\Kernel\Traits\HasStatus;
use App\Models\Kernel\Traits\PendingContractImplemented;
use App\Models\WorkOrder\Traits\HasWorkOrders;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model implements FilterableQueryStringContract, PendingAttributesContract
{
    use BelongsCreatorUser;
    use BelongsUpdaterUser;
    use BelongsClient;
    use BelongsContractor;
    use BelongsCrew;
    use HasFactory; 
    use HasFilterableQueryStringContract;
    use HasHistory;
    use HasScheduledDate;
    use HasStatus;
    use HasWorkOrders;
    use PendingContractImplemented;

    const STATUS_INITIAL = 'new';

    public static $statuses = [
        'new',
        'working',
        'done',
        'reschedule',
        'deferred', 
        'denialed',
        'canceled',
    ];

    protected $fillable = [
        'scheduled_date',
        'ordered',
        'status',
        'notes', 
        'is_walk_thru',
        'client_id',
        'contractor_id',
        'crew_id',
    ];

    protected $casts = [
        'scheduled_date' => 'date',
    ];


    // Accessors

    public function getTypeAttribute()
    {
        return $this->isWalkThru() ? 'walk thru' : 'regular';
    }
    

    // Validators

    public function isWalkThru()
    {
        return (bool) $this->is_walk_thru;
    }

    public function hasPending(): bool
    {
        return !$this->hasScheduledDate() ||! $this->hasCrew();
    }

    public function hasNoPending(): bool
    {
        return ! $this->hasPending();
    }


    // Relationships

    public function members()
    {
        return $this->belongsToMany(Member::class);
    }


    // Scopes

    public function scopeWithEssentialRelationships($query)
    {
        return $query->with([
            'client',
            'contractor',
            'crew',
        ]);
    }

    public function scopePending($query)
    {
        return $query->whereNull('scheduled_date')->orWhereNull('crew_id');
    }

    public function scopeNoPending($query)
    {
        return $query->whereNotNull('scheduled_date')->whereNotNull('crew_id');
    }


    // Filters

    public function scopeFilterByType($query, $value)
    {
        if(! in_array($value, [0,1]) ) {
            return $query;
        }

        return $query->where('is_walk_thru', $value);
    }


    // Interface

    public function getMappingFilterableQueryString(): array
    {
        return [
            'client' => 'filterByClient',
            'contractor' => 'filterByContractor',
            'crew' => 'filterByCrew', 
            'dates' => 'filterByScheduledDateBetween',
            'pending' => 'filterByPending',
            'scheduled_date' => 'filterByScheduledDate',
            'status_group' => 'filterByStatusGroup',
            'status' => 'filterByStatus',
            'type' => 'filterByType',
        ];
    }


    // Static

    public static function statuses()
    {
        return collect(self::$statuses);
    }
}
