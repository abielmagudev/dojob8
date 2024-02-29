<?php

namespace App\Models\Kernel\Traits;

use App\Models\WorkOrder;
use Illuminate\Database\Eloquent\Model;

trait HasAttributesPending
{
    /**
     * Declare the $attributes_to_check_pending static property 
     * and set an array with the attributes to check whether 
     * they are pending or not.
     */

    // Validators

    public function hasPendingAttributes(array $only = [])
    {
        return self::checkPendingAttributes($this, $only);
    }

    public function hasPendingAttribute(string $attribute)
    {
        return self::checkPendingAttributes($this, [$attribute]);
    }


    // Scopes

    public function scopePendingAttributes($query)
    {
        if(! self::hasAttributesToCheckPending() ) {
            return $query;
        }

        $attributes_to_check_pending = self::getAttributesToCheckPending();

        foreach($attributes_to_check_pending as $attribute)
        {
            if( empty( $query->getQuery()->wheres ) )
            {
                $query->whereNull($attribute);
                continue;
            }

            $query->orWhereNull($attribute);
        }

        return $query; 
    }

    public function scopeNonPendingAttributes($query)
    {
        if(! self::hasAttributesToCheckPending() ) {
            return $query;
        }

        $attributes_to_check_pending = self::getAttributesToCheckPending();

        foreach($attributes_to_check_pending as $attribute) {
            $query->whereNotNull($attribute);
        }

        return $query; 
    }


    // Filters

    public function scopeFilterByPendingAttributes($query, $value)
    {
        if( is_null($value) ) {
            return $query;
        }

        if( $value == 1 ) {
            return $query->pendingAttributes();
        }

        return $query->nonPendingAttributes();
    }


    // Statics

    public static function hasAttributesToCheckPending()
    {
        return property_exists(self::class, 'attributes_to_check_pending') &&! empty( self::$attributes_to_check_pending );
    }

    public static function getAttributesToCheckPending()
    {
        return self::hasAttributesToCheckPending() ? self::$attributes_to_check_pending : [];
    }

    public static function checkPendingAttributes(Model $model, array $only = [])
    {
        $attributes_to_check_pending = self::getAttributesToCheckPending();
        
        $attributes = empty($only) ? $model->getAttributes() : array_intersect_key($model->getAttributes(), array_flip($only));

        $pending = array_filter($attributes, function ($value, $attribute) use ($attributes_to_check_pending) {
            return in_array($attribute, $attributes_to_check_pending) && empty($value);
        }, ARRAY_FILTER_USE_BOTH);

        return count($pending) > 0;
    }
}
