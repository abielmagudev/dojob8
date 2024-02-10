<?php 

namespace App\Models\WorkOrder\Traits;

trait Attributes
{
    public function getTypeAttribute()
    {
        if( $this->isRework() ) {
            return 'rework';
        }

        if( $this->isWarranty() ) {
            return 'warranty';
        }

        return 'standard';
    }
}
