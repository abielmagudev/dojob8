<?php

namespace App\Http\Controllers;

use App\Http\Requests\InspectionSaveRequest;
use App\Models\Inspection;
use App\Models\Inspector;
use App\Models\WorkOrder;
use Illuminate\Http\Request;

class InspectionController extends Controller
{
    public function index()
    {
        return view('inspections.index', [
            'inspections' => Inspection::with([
                                'inspector', 
                                'work_order.job', 
                                'work_order.client'
                            ])
                            ->orderBy('scheduled_date', 'desc')
                            ->paginate(25),
        ]);
    }

    public function create(WorkOrder $work_order)
    {
        return view('inspections.create', [
            'inspection' => new Inspection,
            'inspectors' => Inspector::all(),
            'work_order' => $work_order,
        ]);
    }

    public function store(InspectionSaveRequest $request)
    {
        if(! $inspection = Inspection::create( $request->validated() ) ) {
            return back()->with('danger', 'Error saving inspection, try again please');
        }

        return redirect()->route('work-orders.show', $inspection->work_order_id)->with('success', "You saved inspection <b>{$inspection->id}</b>");
    }

    public function show(Inspection $inspection)
    {
        $previous = Inspection::before($inspection->id)->first();
        $next = Inspection::after($inspection->id)->first();

        return view('inspections.show', [
            'inspection' => $inspection,
            'routes' => [
                'previous' => $previous ? route('inspections.show', $previous) : false,
                'next' => $next ? route('inspections.show', $next) : false,
            ],
        ]);
    }

    public function edit(Request $request, Inspection $inspection)
    {
        return view('inspections.edit', [
            'inspection' => $inspection,
            'inspectors' => Inspector::all(),
        ]);
    }

    public function update(InspectionSaveRequest $request, Inspection $inspection)
    {
        if(! $inspection->fill( $request->validated() )->save() ) {
            return back()->with('danger', 'Error updating inspection, try again please');
        }

        return redirect()->route('inspections.edit', $inspection)->with('success', "You updated inspection <b>{$inspection->id}</b>");
    }

    public function destroy(Inspection $inspection)
    {
        if(! $inspection->delete() ) {
            return back()->with('danger', 'Error deleting inspection, try again please');
        }

        return redirect()->route('work-orders.show', $inspection->work_order_id)->with('success', "You deleted inspection <b>{$inspection->id}</b>");
    }
}
