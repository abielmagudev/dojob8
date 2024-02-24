<?php

namespace App\Xapis\Stock\BattInsulationMaterial\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Extension;
use App\Models\WorkOrder;
use App\Xapis\Stock\BattInsulationMaterial\Kernel\BattMaterialRequirements;
use App\Xapis\Stock\BattInsulationMaterial\Kernel\Rvalue;
use App\Xapis\Stock\BattInsulationMaterial\Kernel\Size;
use App\Xapis\Stock\BattInsulationMaterial\Kernel\Type;
use App\Xapis\Stock\BattInsulationMaterial\Models\BattInsMatWorkOrder;
use App\Xapis\Stock\BattInsulationMaterial\Requests\BattInsulationMaterialSaveRequest;
use Illuminate\Http\Request;

class BattInsMatWorkOrderController extends Controller
{
    public function create(Extension $extension)
    {
        return view('BattInsulationMaterial.views.work-orders.form', [
            'extension' => $extension,
            'spaces_rvalues' => Rvalue::collection(),
            'sizes' => Size::all(),
            'types' => Type::all(),
            'battInsMat' => new BattInsMatWorkOrder,
        ]);
    }

    public function store(BattInsulationMaterialSaveRequest $request, WorkOrder $work_order)
    {
        $validated = array_merge($request->validated(), [
            'work_order_id' => $work_order->id
        ]);

        return BattInsMatWorkOrder::create($validated);
    }

    public function show(Extension $extension, WorkOrder $work_order)
    {
        return view('BattInsulationMaterial.views.work-orders.show', [
            'extension' => $extension,
            'battInsMat' => BattInsMatWorkOrder::where('work_order_id', $work_order->id)->first(),
        ]);
    }

    public function edit(Extension $extension, WorkOrder $work_order)
    {
        return view('BattInsulationMaterial.views.work-orders.form', [
            'extension' => $extension,
            'spaces_rvalues' => Rvalue::collection(),
            'sizes' => Size::all(),
            'types' => Type::all(),
            'battInsMat' => BattInsMatWorkOrder::where('work_order_id', $work_order->id)->first(),
        ]);
    }

    public function update(BattInsulationMaterialSaveRequest $request, WorkOrder $work_order)
    {
        return BattInsMatWorkOrder::where('work_order_id', $work_order->id)->update( $request->validated() );
    }
}
