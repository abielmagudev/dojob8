<?php

namespace App\Xapis\Stock\CelluloseInsulation\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Extension;
use App\Models\WorkOrder;
use App\Xapis\Stock\CelluloseInsulation\Kernel\RvalueManager;
use App\Xapis\Stock\CelluloseInsulation\Models\CelluloseInsulationWorkOrder;
use App\Xapis\Stock\CelluloseInsulation\Requests\CelluloseInsulationSaveRequest;
use Illuminate\Http\Request;

class CelluloseInsulationWorkOrderController extends Controller
{
    public function create(Extension $extension)
    {
        return view('CelluloseInsulation.views.work-orders.form', [
            'extension' => $extension,
            'spaces' => RvalueManager::spaces(),
            'rvalues' => RvalueManager::all(),
            'celluloseins' => new CelluloseInsulationWorkOrder,
        ]);
    }

    public function store(CelluloseInsulationSaveRequest $request, WorkOrder $work_order)
    {
        $validated = array_merge($request->validated(), [
            'work_order_id' => $work_order->id
        ]);

        return CelluloseInsulationWorkOrder::create($validated);
    }

    public function show(Extension $extension, WorkOrder $work_order)
    {
        return view('CelluloseInsulation.views.work-orders.show', [
            'extension' => $extension,
            'celluloseins' => CelluloseInsulationWorkOrder::where('work_order_id', $work_order->id)->first(),
        ]);
    }

    public function edit(Extension $extension, WorkOrder $work_order)
    {
        return view('CelluloseInsulation.views.work-orders.form', [
            'extension' => $extension,
            'spaces' => RvalueManager::spaces(),
            'rvalues' => RvalueManager::all(),
            'celluloseins' => CelluloseInsulationWorkOrder::where('work_order_id', $work_order->id)->first(),
        ]);
    }

    public function update(CelluloseInsulationSaveRequest $request, WorkOrder $work_order)
    {
        return CelluloseInsulationWorkOrder::where('work_order_id', $work_order->id)->update( $request->validated() );
    }
}
