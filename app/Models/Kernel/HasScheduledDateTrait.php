<?php 

namespace App\Models\Kernel;

use Carbon\Carbon;

trait HasScheduledDateTrait
{
    // IMPORTANT: Set "scheduled_date" in the property protect $casts to cast with Carbon::class


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

    /**
     *  Carbon::class
     * 
     *  Carbon::parse($this->scheduled_date)->format('Y-m-d');
     */


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

    public function scopeWhereScheduledDate($query, $value)
    {
        return $query->where('scheduled_date', $value);
    }

    public function scopeWhereScheduledDateFrom($query, $value)
    {
        return $query->where('scheduled_date', '>=', $value);
    }

    public function scopeWhereScheduledDateTo($query, $value)
    {
        return $query->where('scheduled_date', '<=', $value);
    }

    public function scopeWhereScheduledDateBetween($query, $values)
    {
        return $query->whereBetween('scheduled_date', $values);
    }


    // Filters

    public function scopeFilterByScheduledDate($query, $value)
    {
        return ! is_null($value) ? $query->whereScheduledDate($value) : $query;
    }

    public function scopeFilterByScheduledDateBetween($query, $values)
    {
        if(! isset($values['from']) &&! isset($values['to']) ) {
            return $query;
        }

        if( isset($values['from']) &&! isset($values['to']) ) {
            return $query->whereScheduledDateFrom($values['from']);
        }
        
        if(! isset($values['from']) && isset($values['to']) ) {
            return $query->whereScheduledDateTo($values['to']);
        }

        return $query->whereScheduledDateBetween($values);
    }
}
