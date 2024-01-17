<?php

namespace App\Models;

use App\Models\Kernel\FilteringInterface;
use App\Models\Kernel\HasFilteringTrait;
use App\Models\Kernel\HasHookUsersTrait;
use App\Models\Kernel\HasScheduledDateTrait;
use App\Models\WorkOrder\HasWorkOrdersTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inspection extends Model implements FilteringInterface
{
    use HasFactory;
    use HasFilteringTrait;
    use HasHookUsersTrait;
    use HasScheduledDateTrait;
    use HasWorkOrdersTrait;

    protected $fillable = [
        'scheduled_date',
        'observations',
        'status',
        'work_order_id',
        'inspector_id',
        'crew_id',
    ];

    public static $all_statuses = [
        'pending',
        'on hold',
        'passed',
        'failed',
    ];

    protected $casts = [
        'scheduled_date' => 'date',
    ];

    
    // Interface

    public function inputFilterSettings(): array
    {
        return [
            'crew' => 'filterByCrew',
            'inspector' => 'filterByInspector',
            'dates' => 'filterByScheduledDateBetween',
            'scheduled_date' => 'filterByScheduledDate',
            'status_group' => 'filterByStatusGroup',
            'status' => 'filterByStatus', 
        ];
    }


    // Validators

    public function hasCrew()
    {
        return ! is_null($this->crew_id) && is_a($this->crew, Crew::class);
    }

    public function hasStatus(string $status)
    {
        return $this->status == $status;
    }

    public function isPendingStatus()
    {
        return self::validateIsPendingStatus([
            'scheduled_date' => $this->getRawOriginal('scheduled_date'),
            'crew_id' => $this->crew_id,
        ]);
    }


    // Scopes

    public function scopeWhereCrew($query, int $crew_id)
    {
        return $query->where('crew_id', $crew_id);
    }

    public function scopeWhereInspector($query, int $inspector_id)
    {
        return $query->where('inspector_id', $inspector_id);
    }

    public function scopeWhereStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeWhereInStatus($query, $status_group)
    {
        return $query->whereIn('status', $status_group);
    }

    public function scopeWithRelationsForIndex($query)
    {
        return $query->with([
            'crew',
            'inspector', 
            'work_order.job', 
            'work_order.client',
        ]);
    }


    // Filters

    public function scopeFilterByCrew($query, $crew_id)
    {
        return ! is_null($crew_id) ? $query->whereCrew($crew_id) : $query;
    }

    public function scopeFilterByInspector($query, $inspector_id)
    {
        return ! is_null($inspector_id) ? $query->whereInspector($inspector_id) : $query;
    }

    public function scopeFilterByStatusGroup($query, $status_group)
    {
        return is_array($status_group) &&! empty($status_group) ? $query->whereInStatus($status_group) : $query;
    }

    public function scopeFilterByStatus($query, $status)
    {
        return ! is_null($status) ? $query->whereStatus($status) : $query;
    }


    // Relationships

    public function crew()
    {
        return $this->belongsTo(Crew::class);
    }

    public function inspector()
    {
        return $this->belongsTo(Inspector::class);
    }


    // Statics

    public static function getAllStatuses()
    {
        return collect( self::$all_statuses );
    }

    public static function getFormStatuses()
    {
        return self::getAllStatuses()->filter(fn($status) => $status <> 'pending');
    }

    public static function validateIsPendingStatus(array $values)
    {
        return ! empty( 
            array_filter($values, function ($value, $key) {
                return in_array($key, ['crew', 'crew_id', 'scheduled_date']) && empty($value);
            }, ARRAY_FILTER_USE_BOTH)
        );
    }
}
