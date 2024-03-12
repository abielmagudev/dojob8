<?php

namespace App\Xapis\Stock\BlownInsulation\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Extension;
use App\Models\WorkOrder;
use App\Xapis\Stock\BlownInsulation\Kernel\AreaRvalueCatalog;
use App\Xapis\Stock\BlownInsulation\Models\BlownInsulationWorkOrder;
use App\Xapis\Stock\BlownInsulation\Requests\BlownInsulationSaveRequest;
use Illuminate\Http\Request;

class BlownInsulationWorkOrderController extends Controller
{
    public function create(Extension $extension)
    {
        return view('BlownInsulation.views.work-orders.form', [
            'extension' => $extension,
            'areas_rvalues' => AreaRvalueCatalog::all(),
            'blownins' => new BlownInsulationWorkOrder,
        ]);
    }

    public function store(BlownInsulationSaveRequest $request, WorkOrder $work_order)
    {
        $validated = array_merge($request->validated(), [
            'work_order_id' => $work_order->id
        ]);

        return BlownInsulationWorkOrder::create($validated);
    }

    public function show(Extension $extension, WorkOrder $work_order)
    {
        return view('BlownInsulation.views.work-orders.show', [
            'extension' => $extension,
            'blownins' => BlownInsulationWorkOrder::where('work_order_id', $work_order->id)->first(),
        ]);
    }

    public function edit(Extension $extension, WorkOrder $work_order)
    {
        return view('BlownInsulation.views.work-orders.form', [
            'extension' => $extension,
            'areas_rvalues' => AreaRvalueCatalog::all(),
            'blownins' => BlownInsulationWorkOrder::where('work_order_id', $work_order->id)->first(),
        ]);
    }

    public function update(BlownInsulationSaveRequest $request, WorkOrder $work_order)
    {
        return BlownInsulationWorkOrder::where('work_order_id', $work_order->id)->update( $request->validated() );
    }
}
