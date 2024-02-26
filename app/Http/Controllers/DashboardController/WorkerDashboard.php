<?php 

namespace App\Http\Controllers\DashboardController;

use App\Models\Inspection;
use App\Models\WorkOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class WorkerDashboard
{
    public static function response(Request $request)
    {
        $today = Carbon::today();
        $worker = auth()->user()->profile;
        $work_orders_id = $worker->has('work_orders')->get() ? $worker->work_orders->pluck('id')->toArray() : false;
        $inspections_id = $worker->has('inspections')->get() ? $worker->inspections->pluck('id')->toArray() : false;
        $work_orders = ! empty($work_orders_id) ? WorkOrder::whereIn('id', $work_orders_id)->whereDate('scheduled_date', $today)->get() : collect([]);
        $inspections = ! empty($inspections_id) ? Inspection::whereIn('id', $inspections_id)->whereDate('scheduled_date', $today)->get() : collect([]);

        return view('dashboard.worker.index', [
            'request' => $request,
            'today' => $today,
            'inspections' => $inspections,
            'work_orders' => $work_orders,
        ]);
    }
}
