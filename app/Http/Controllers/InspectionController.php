<?php

namespace App\Http\Controllers;

use App\Http\Requests\InspectionSaveRequest;
use App\Models\Inspection;
use App\Models\Inspector;
use App\Models\Order;
use Illuminate\Http\Request;

class InspectionController extends Controller
{
    public function index()
    {
        return view('inspections.index', [
            'inspections' => Inspection::with(['inspector', 'order.job', 'order.client'])->orderBy('scheduled_date', 'desc')->paginate(25),
        ]);
    }

    public function create(Order $order)
    {
        return view('inspections.create', [
            'inspection' => new Inspection,
            'inspectors' => Inspector::all(),
            'order' => $order,
        ]);
    }

    public function store(InspectionSaveRequest $request)
    {
        if(! $inspection = Inspection::create( $request->validated() ) ) {
            return back()->with('danger', 'Error saving inspection, try again please');
        }

        return redirect()->route('orders.show', $inspection->order_id)->with('success', "You saved inspection <b>{$inspection->id}</b>");
    }

    public function show(Inspection $inspection)
    {
        return view('inspections.show', [
            'inspection' => $inspection,
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

        return redirect()->route('inspections.index')->with('success', "You deleted inspection <b>{$inspection->id}</b>");
    }
}
