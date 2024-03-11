<?php 

namespace App\Http\Controllers\DashboardController\Responses;

use App\Models\Inspection;
use App\Models\WorkOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CrewMemberResponse
{
    public static function response(Request $request)
    {
        $today = Carbon::today();
        $crew_member = auth()->user()->profile;
        $work_orders_id = $crew_member->has('work_orders')->get() ? $crew_member->work_orders->pluck('id')->toArray() : false;
        $inspections_id = $crew_member->has('inspections')->get() ? $crew_member->inspections->pluck('id')->toArray() : false;
        $work_orders = ! empty($work_orders_id) ? WorkOrder::whereIn('id', $work_orders_id)->whereDate('scheduled_date', $today)->get() : collect([]);
        $inspections = ! empty($inspections_id) ? Inspection::whereIn('id', $inspections_id)->whereDate('scheduled_date', $today)->get() : collect([]);

        return view('dashboard.crew-member.index', [
            'request' => $request,
            'today' => $today,
            'inspections' => $inspections,
            'work_orders' => $work_orders,
        ]);
    }
}
