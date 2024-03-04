<?php 

namespace App\Models\Kernel\Traits;

use Exception;
use Illuminate\Support\Facades\DB;

trait HasPendingAttributes
{
    // Validators

    public function hasPendingAttributes()
    {
        $pending_attributes_defined = self::getPendingAttributesDefined();

        $has_pending_attributes = array_filter($this->getAttributes(), function($value, $attribute) use ($pending_attributes_defined) {
            return in_array($attribute, $pending_attributes_defined) && is_null($value);
        }, ARRAY_FILTER_USE_BOTH);

        return count($has_pending_attributes) > 0;
    }

    public function hasNoPendingAttributes()
    {
        return ! $this->hasPendingAttributes();
    }

    
    // Scopes

    public function scopePendingAttributes($query)
    {
        $pending_attributes = self::getPendingAttributesDefined();

        foreach($pending_attributes as $index => $attribute)
        {
            $query = $index == 0 ? $query->whereNull($attribute) : $query->orWhereNull($attribute);
        }
        
        return $query;
    }

    public function scopeNoPendingAttributes($query)
    {
        $pending_attributes = self::getPendingAttributesDefined();

        foreach($pending_attributes as $attribute)
        {
            $query = $query->whereNotNull($attribute);
        }

        return $query;
    }

    public function scopePendingAttributesCount($query)
    {
        $query->select( DB::raw('COUNT(*) as pending_attributes_count') );

        $query = $query->pendingAttributes();

        return $query;
    }


    // Filters

    public function scopeFilterByPendingAttributes($query, $value)
    {
        if(! in_array($value, [0,1]) ) {
            return $query;
        }

        if( $value == 0 ) {
            return $query->noPendingAttributes();
        }
        
        return $query->pendingAttributes();
    }



    // Statics

    public static function getPendingAttributesDefined()
    {
        if(! property_exists(self::class, 'pending_attributes') ) {
            throw new Exception('Property static $pending_attributes is not defined', 500);
        }

        return self::$pending_attributes;
    }
}
