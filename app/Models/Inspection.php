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
        'approved' => [
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
        'between_dates' => 'filterBetweenScheduledDate',
    ];

    protected $fillable = [
        'scheduled_date',
        'observations',
        'notes',
        'is_approved',
        'inspector_id',
        'work_order_id',
    ];

    protected $casts = [
        'scheduled_date' => 'date',
    ];



    // Attributes

    public function getSettingsByIsApprovedAttribute()
    {
        return self::getStatusesSettings()->filter(function ($settings) {
            return $settings['value'] === $this->is_approved;
        });
    }

    public function getStatusAttribute()
    {
        return $this->settings_by_is_approved->keys()[0];
    }

    public function getStatusColorAttribute()
    {
        return $this->settings_by_is_approved->first()['bscolor'];
    }

    public function getScheduledDateInputAttribute()
    {
        return $this->scheduled_date ? $this->scheduled_date->format('Y-m-d') : null;
    }

    public function getScheduledDateHumanAttribute()
    {
        return $this->scheduled_date ? $this->scheduled_date->format('D d M, Y') : null;
    }



    // Validations

    public function isOnHold()
    {
        return $this->is_approved == 0;
    }

    public function isApproved()
    {
        return $this->is_approved == 1;
    }

    public function isFailed()
    {
        return $this->is_approved == -1;
    }

    public function hasObservations()
    {
        return ! empty($this->observations);
    }



    // Scopes

    public function scopePendings($query)
    {
        return $query->where('is_approved', 0);
    }

    public function scopeWhereInspector($query, int $inspector_id)
    {
        return $query->where('inspector_id', $inspector_id);
    }

    public function scopeWhereIsApproved($query, int $value)
    {
        return $query->where('is_approved', $value);
    }

    public function scopeWhereIsApprovedIn($query, array $values)
    {
        return $query->whereIn('is_approved', $values);
    }

    public function scopeWhereIsApprovedNotIn($query, array $values)
    {    
        return $query->whereNotIn('is_approved', $values);
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

    public function scopeFilterByStatus($query, $status_rule, $status_group = [])
    {
        if( is_null($status_rule) ||! in_array($status_rule, ['only','except']) || empty($status_group) ) {
            return $query;
        }
        if( $status_rule == 'only' ) {
            return $query->whereIsApprovedIn($status_group);
        }

        return $query->whereIsApprovedNotIn($status_group);
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

    public function inspector()
    {
        return $this->belongsTo(Inspector::class);
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
