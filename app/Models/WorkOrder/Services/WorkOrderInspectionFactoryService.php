<?php 

namespace App\Models\WorkOrder\Services;

use App\Models\Inspection;
use App\Models\WorkOrder;

class WorkOrderInspectionFactoryService
{
    public static function create(WorkOrder $work_order)
    {
        $setup = $work_order->job->inspections_setup->all();

        $created = [];

        foreach($setup->all() as $setting)
        {
            $created[] = Inspection::create([
                'agency_id' => $setting['agency'],
                'work_order_id' => $work_order->id,
                'status' => 'pending',
            ]);
        }
        
        return $created;
    }
}
