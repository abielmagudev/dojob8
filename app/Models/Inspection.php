<?php

namespace App\Models;

use App\Models\Kernel\FilteringInterface;
use App\Models\Kernel\HasFilteringTrait;
use App\Models\Kernel\HasHookUsersTrait;
use App\Models\WorkOrder\HasWorkOrdersTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inspection extends Model implements FilteringInterface
{
    use HasFilteringTrait;
    use HasFactory;
    use HasHookUsersTrait;
    use HasWorkOrdersTrait;

    public static $all_statuses = [
        'pending',
        'on hold',
        'passed',
        'failed',
    ];

    protected $fillable = [
        'scheduled_date',
        'observations',
        'status',
        'crew_id',
        'inspector_id',
        'work_order_id',
    ];

    protected $casts = [
        'scheduled_date' => 'date',
    ];


    // Interface

    public function inputFilterSettings(): array
    {
        return [
            'between_scheduled_date' => 'filterBetweenScheduledDate',
            'crew' => 'filterByCrew',
            'inspector' => 'filterByInspector',
            'scheduled_date' => 'filterScheduledDate',
            'status_group' => 'filterByStatusGroup',
            'status' => 'filterByStatus', 
        ];
    }

    // Attributes

    public function getScheduledDateInputAttribute()
    {
        return $this->scheduled_date ? $this->scheduled_date->format('Y-m-d') : null;
    }

    public function getScheduledDateHumanAttribute()
    {
        return $this->scheduled_date ? $this->scheduled_date->format('D d M, Y') : null;
    }



    // Validatiors

    public function hasScheduledDate()
    {
        return ! empty($this->getRawOriginal('scheduled_date'));
    }

    public function isToday()
    {
        return $this->getRawOriginal('scheduled_date') == now()->toDateString();
    }

    public function hasCrew()
    {
        return ! is_null($this->crew_id) && is_a($this->crew, Crew::class);
    }

    public function isPendingStatus()
    {
        return self::validateIsPendingStatus([
            $this->getRawOriginal('scheduled_date'),
            $this->crew_id,
        ]);
    }

    public function hasStatus(string $status)
    {
        return $this->status == $status;
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

    public function scopeWhereScheduledDate($query, $scheduled_date)
    {
        return $query->where('scheduled_date', $scheduled_date);
    }

    public function scopeWhereScheduledDateFrom($query, $scheduled_date_from)
    {
        return $query->where('scheduled_date', '>=', $scheduled_date_from);
    }

    public function scopeWhereScheduledDateTo($query, $scheduled_date_to)
    {
        return $query->where('scheduled_date', '<=', $scheduled_date_to);
    }

    public function scopeWhereScheduledDateBetween($query, $between_dates)
    {
        return $query->whereBetween('scheduled_date', $between_dates);
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

    public function scopeFilterScheduledDate($query, $scheduled_date)
    {
        return ! is_null($scheduled_date) ? $query->whereScheduledDate($scheduled_date) : $query;
    }

    public function scopeFilterBetweenScheduledDates($query, $between_scheduled_date)
    {
        if(! isset($between_scheduled_date['from']) &&! isset($between_scheduled_date['to']) ) {
            return $query;
        }

        if( isset($between_scheduled_date['from']) &&! isset($between_scheduled_date['to']) ) {
            return $query->whereScheduledDateFrom($between_scheduled_date['from']);
        }
        
        if(! isset($between_scheduled_date['from']) && isset($between_scheduled_date['to']) ) {
            return $query->whereScheduledDateTo($between_scheduled_date['to']);
        }

        return $query->whereScheduledDateBetween($between_scheduled_date);
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

    public function work_order()
    {
        return $this->belongsTo(WorkOrder::class);
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
        $empty_values = array_filter($values, fn($value) => empty($value));

        return count($empty_values) > 0;
    }
}
