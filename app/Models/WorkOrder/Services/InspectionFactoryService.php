<?php 

namespace App\Models\WorkOrder\Services;

use App\Models\Inspection;
use App\Models\Inspection\Kernel\InspectionStatusCatalog;
use App\Models\WorkOrder;

class InspectionFactoryService
{
    public static function create(WorkOrder $work_order)
    {
        $created = [];

        if(! $work_order->job->hasInspectionSetup() ) {
            return $created;
        }

        foreach($work_order->job->inspection_setup as $inspection_setup)
        {
            $inspection = Inspection::create([
                'agency_id' => $inspection_setup->options->agency,
                'work_order_id' => $work_order->id,
                'status' => InspectionStatusCatalog::INITIAL,
            ]);

            // Code to attach crew members of inspection(service)

            array_push($created, $inspection);
        }
        
        return $created;
    }
}
