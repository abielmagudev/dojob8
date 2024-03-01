<?php

namespace App\Models\WorkOrder\Traits;

trait Filters
{
    // Interface: App\Models\Kernel\Interfaces\Filterable;

    public function getParameterFilterSettings(): array
    {
        return [
            'client' => 'filterByClient',
            'contractor' => 'filterByContractor',
            'crew' => 'filterByCrew', 
            'dates' => 'filterByScheduledDateBetween',
            'job' => 'filterByJob',
            'payment_status_group' => 'filterByPaymentStatusGroup',
            'pending' => 'filterByPendingAttributes',
            'scheduled_date' => 'filterByScheduledDate',
            'search' => 'filterBySearch',
            'status_group' => 'filterByStatusGroup',
            'status' => 'filterByStatus',
            'type_group' => 'filterByTypeGroup',
        ];
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
    
    public function scopeFilterByCrew($query, $value)
    {
        return ! is_null($value) ? $query->where('crew_id', $value) : $query;
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

    public function scopeFilterByTypeGroup($query, $type_group)
    {
        if( empty($type_group) || count($type_group) == 3 ) {
            return $query;
        }

        if( count($type_group) == 2 && in_array('rework', $type_group) && in_array('warranty', $type_group) ) {
            return $query->whereNotNull('rework_id')->whereNotNull('warranty_id');
        }

        if( count($type_group) == 2 && in_array('rework', $type_group) &&! in_array('warranty', $type_group) ) {
            return $query->whereNull('warranty_id');
        }

        if( count($type_group) == 2 && in_array('warranty', $type_group) &&! in_array('rework', $type_group) ) {
            return $query->whereNull('rework_id');
        }

        if( count($type_group) == 1 && in_array('rework', $type_group) ) {
            return $query->whereNotNull('rework_id');
        }

        if( count($type_group) == 1 && in_array('warranty', $type_group) ) {
            return $query->whereNotNull('warranty_id');
        }

        return $query->whereNull('rework_id')->whereNull('warranty_id');
    }

    public function scopeFilterByPendingAttributes($query, $value)
    {
        if( is_null($value) ) {
            return $query;
        }

        if( $value == 0 ) {
            return $query->notPending();
        }

        return $query->pending();
    }
}
