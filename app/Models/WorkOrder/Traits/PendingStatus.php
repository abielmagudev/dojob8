<?php

namespace App\Models\WorkOrder\Traits;

trait PendingStatus
{
    // Properties

    public static $attributes_for_pending_status = [
        'scheduled_date',
    ];


    // Validators

    public function qualifiesForPendingStatus()
    {
        return self::qualifyForPendingStatus($this->getAttributes());
    }

    
    // Scopes

    public function scopeNoPendingStatus($query)
    {
        return $query->where('status', '!=', 'pending');
    }


    // Statics

    public static function qualifyForPendingStatus(array $data)
    {
        $qualified = array_filter(self::$attributes_for_pending_status, function ($attr) use ($data) {
            return array_key_exists($attr, $data) && empty($data[$attr]);
        });

        return count($qualified) > 0;
    }
}
