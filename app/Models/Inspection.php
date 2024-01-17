<?php

namespace App\Models;

use App\Models\Kernel\FilteringInterface;
use App\Models\Kernel\HasFilteringTrait;
use App\Models\Kernel\HasHookUsersTrait;
use App\Models\Kernel\HasScheduledDateTrait;
use App\Models\Kernel\HasStatusTrait;
use App\Models\WorkOrder\HasWorkOrdersTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inspection extends Model implements FilteringInterface
{
    use HasFactory;
    use HasFilteringTrait;
    use HasHookUsersTrait;
    use HasScheduledDateTrait;
    use HasStatusTrait;
    use HasWorkOrdersTrait;

    protected $fillable = [
        'scheduled_date',
        'observations',
        'status',
        'work_order_id',
        'inspector_id',
        'crew_id',
    ];

    protected $casts = [
        'scheduled_date' => 'date',
    ];

    public static $all_status = [
        'pending',
        'on hold',
        'passed',
        'failed',
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

    public function scopeWithNestedRelationships($query)
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

    public static function getAllStatus()
    {
        return collect( self::$all_status );
    }

    public static function getAllStatusForm()
    {
        return self::getAllStatus()->reject(fn($status) => $status == 'pending');
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
