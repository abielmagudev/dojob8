<?php

namespace App\Xapis\Stock\BattInsulation\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Extension;
use App\Models\WorkOrder;
use App\Xapis\Stock\BattInsulation\Kernel\Rvalue;
use App\Xapis\Stock\BattInsulation\Kernel\Size;
use App\Xapis\Stock\BattInsulation\Kernel\Type;
use App\Xapis\Stock\BattInsulation\Models\BattInsulationWorkOrder;
use App\Xapis\Stock\BattInsulation\Requests\BattInsulationSaveRequest;
use Illuminate\Http\Request;

class BattInsulationWorkOrderController extends Controller
{
    public function create(Extension $extension)
    {
        return view('BattInsulation.views.work-orders.form', [
            'extension' => $extension,
            'rvalues_by_space' => Rvalue::collection(),
            'sizes' => Size::all(),
            'types' => Type::all(),
            'battins' => new BattInsulationWorkOrder,
        ]);
    }

    public function store(BattInsulationSaveRequest $request, WorkOrder $work_order)
    {
        $validated = array_merge($request->validated(), [
            'work_order_id' => $work_order->id
        ]);

        return BattInsulationWorkOrder::create($validated);
    }

    public function show(Extension $extension, WorkOrder $work_order)
    {
        return view('BattInsulation.views.work-orders.show', [
            'extension' => $extension,
            'battins' => BattInsulationWorkOrder::where('work_order_id', $work_order->id)->first(),
        ]);
    }

    public function edit(Extension $extension, WorkOrder $work_order)
    {
        return view('BattInsulation.views.work-orders.form', [
            'extension' => $extension,
            'rvalues_by_space' => Rvalue::collection(),
            'sizes' => Size::all(),
            'types' => Type::all(),
            'battins' => BattInsulationWorkOrder::where('work_order_id', $work_order->id)->first(),
        ]);
    }

    public function update(BattInsulationSaveRequest $request, WorkOrder $work_order)
    {
        return BattInsulationWorkOrder::where('work_order_id', $work_order->id)->update( $request->validated() );
    }
}
