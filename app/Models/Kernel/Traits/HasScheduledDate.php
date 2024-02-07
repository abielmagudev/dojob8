<?php 

namespace App\Models\Kernel\Traits;

/**
 * IMPORTANT: Set "scheduled_date" in the property protect $casts to cast with Carbon::class
 * 
 * Carbon\Carbon::parse($this->scheduled_date)->format('Y-m-d');
 */

trait HasScheduledDate
{
    // Attributes

    public function getScheduledDateRawAttribute()
    {
        return $this->scheduled_date ? $this->getRawOriginal('scheduled_date') : null;
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

    public function hasScheduledDate()
    {
        return ! empty($this->scheduled_date_raw);
    }

    public function isToday()
    {
        return $this->scheduled_date_raw == now()->toDateString();
    }


    // Scopes

    public function scopeScheduledDateIs($query, $value)
    {
        return $query->where('scheduled_date', $value);
    }

    public function scopeScheduledDateFrom($query, $value)
    {
        return $query->where('scheduled_date', '>=', $value);
    }

    public function scopeScheduledDateTo($query, $value)
    {
        return $query->where('scheduled_date', '<=', $value);
    }

    public function scopeScheduledDateBetween($query, $values)
    {
        return $query->whereBetween('scheduled_date', $values);
    }


    // Filters

    public function scopeFilterByScheduledDate($query, $value)
    {
        return ! is_null($value) ? $query->scheduledDateIs($value) : $query;
    }

    public function scopeFilterByScheduledDateBetween($query, $values)
    {
        if(! isset($values['from']) &&! isset($values['to']) ) {
            return $query;
        }

        if( isset($values['from']) &&! isset($values['to']) ) {
            return $query->scheduledDateFrom($values['from']);
        }
        
        if(! isset($values['from']) && isset($values['to']) ) {
            return $query->scheduledDateTo($values['to']);
        }

        return $query->scheduledDateBetween($values);
    }
}
