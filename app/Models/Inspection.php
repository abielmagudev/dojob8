<?php

namespace App\Models;

use App\Models\Kernel\HasActionsByRequestTrait;
use App\Models\Kernel\HasBeforeAfterTrait;
use App\Models\Kernel\HasHookUsersTrait;
use App\Models\Kernel\HasModelHelpersTrait;
use App\Models\WorkOrder\HasWorkOrdersTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Inspection extends Model
{
    use HasActionsByRequestTrait;
    use HasBeforeAfterTrait;
    use HasFactory;
    use HasHookUsersTrait;
    use HasModelHelpersTrait;
    use HasWorkOrdersTrait;

    public static $statuses_settings = [
        'on hold' => [
            'value' => 0, 
            'bscolor' => 'secondary',
        ],
        'passed' => [
            'value' => 1, 
            'bscolor' => 'success',
        ],
        'failed' => [
            'value' => -1,
            'bscolor' => 'danger',
        ],
    ]; 

    public static $inputs_filters = [
        'status_rule' => ['filterByStatus', 'status_group'],
        'inspector' => 'filterByInspector',
        'crew' => 'filterByCrew',
        'scheduled_date' => 'filterScheduledDate',
        'between_dates' => 'filterBetweenScheduledDate',
    ];

    protected $fillable = [
        'scheduled_date',
        'observations',
        'is_passed',
        'crew_id',
        'inspector_id',
        'work_order_id',
    ];

    protected $casts = [
        'scheduled_date' => 'date',
    ];



    // Attributes

    public function getSettingsByIsPassedAttribute()
    {
        return self::getStatusesSettings()->filter(function ($settings) {
            return $settings['value'] === $this->is_passed;
        });
    }

    public function getStatusAttribute()
    {
        return $this->settings_by_is_passed->keys()[0];
    }

    public function getStatusColorAttribute()
    {
        return $this->settings_by_is_passed->first()['bscolor'];
    }

    public function getScheduledDateInputAttribute()
    {
        return $this->scheduled_date ? $this->scheduled_date->format('Y-m-d') : null;
    }

    public function getScheduledDateHumanAttribute()
    {
        return $this->scheduled_date ? $this->scheduled_date->format('D d M, Y') : null;
    }



    // Validatiors

    public function isOnHold()
    {
        return $this->is_passed == 0;
    }

    public function isPassed()
    {
        return $this->is_passed == 1;
    }

    public function isFailed()
    {
        return $this->is_passed == -1;
    }

    public function hasObservations()
    {
        return ! empty($this->observations);
    }

    public function hasCrew()
    {
        return ! is_null($this->crew_id) && is_a($this->crew, Crew::class);
    }

    public function isToday()
    {
        return $this->getRawOriginal('scheduled_date') == now()->toDateString();
    }


    // Scopes

    public function scopePendings($query)
    {
        return $query->where('is_passed', 0);
    }

    public function scopeWhereInspector($query, int $inspector_id)
    {
        return $query->where('inspector_id', $inspector_id);
    }

    public function scopeWhereCrew($query, int $crew_id)
    {
        return $query->where('crew_id', $crew_id);
    }

    public function scopeWhereIsPassed($query, int $value)
    {
        return $query->where('is_passed', $value);
    }

    public function scopeWhereIsPassedIn($query, array $values)
    {
        return $query->whereIn('is_passed', $values);
    }

    public function scopeWhereIsPassedNotIn($query, array $values)
    {    
        return $query->whereNotIn('is_passed', $values);
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



    // Filters

    public function scopeFilterByInspector($query, $inspector_id)
    {
        if( is_null($inspector_id) ) {
            return $query;
        }

        return $query->whereInspector($inspector_id);
    }

    public function scopeFilterByCrew($query, $crew_id)
    {
        if( is_null($crew_id) ) {
            return $query;
        }

        return $query->whereCrew($crew_id);
    }

    public function scopeFilterByStatus($query, $status_rule, $status_group = [])
    {
        if( is_null($status_rule) ||! in_array($status_rule, ['only','except']) || empty($status_group) ) {
            return $query;
        }
        if( $status_rule == 'only' ) {
            return $query->whereIsPassedIn($status_group);
        }

        return $query->whereIsPassedNotIn($status_group);
    }

    public function scopeFilterScheduledDate($query, $scheduled_date)
    {
        return $query->whereScheduledDate($scheduled_date);
    }

    public function scopeFilterBetweenScheduledDate($query, $between_dates)
    {
        if(! isset($between_dates['from']) &&! isset($between_dates['to']) ) {
            return $query;
        }

        if( isset($between_dates['from']) &&! isset($between_dates['to']) ) {
            return $query->whereScheduledDateFrom($between_dates['from']);
        }
        
        if(! isset($between_dates['from']) && isset($between_dates['to']) ) {
            return $query->whereScheduledDateTo($between_dates['to']);
        }

        return $query->whereScheduledDateBetween($between_dates);
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

    public static function getStatusesSettings()
    {
        return collect(self::$statuses_settings);
    }

    public static function getStatusesValues()
    {
        foreach(self::getStatusesSettings()->all() as $status => $settings)
        {   
            $status_values[$status] = $settings['value'];
        }

        return $status_values;
    }

    public static function getStatuses()
    {
        return self::getStatusesSettings()->keys();
    }

    public static function getStatusValues()
    {
        return array_values( self::getStatusesValues() );
    }

    public static function getSettingsByStatus(string $status)
    {
        return self::getStatusesSettings()->get($status);
    }

    public static function generatePendingInspectionsUrl(array $parameters = [])
    {
        return route('inspections.index', array_merge([
                'status_rule' => 'only',
                'status_group' => [0],
                'sort' => 'asc',
            ], $parameters)
        );
    }
}
