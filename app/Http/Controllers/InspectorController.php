<?php

namespace App\Http\Controllers;

use App\Http\Requests\InspectorSaveRequest;
use App\Models\Inspector;
use Illuminate\Http\Request;

class InspectorController extends Controller
{
    public function index()
    {
        $inspectors = Inspector::with('inspections')
        ->orderBy('name')
        ->paginate(25);

        return view('inspectors.index')->with('inspectors', $inspectors);
    }

    public function create()
    {
        return view('inspectors.create')->with('inspector', new Inspector);
    }

    public function store(InspectorSaveRequest $request)
    {
        if(! $inspector = Inspector::create( $request->validated() ) ) {
            return back()->with('danger', 'Error saving inspector, try again please');
        }

        return redirect()->route('inspectors.index')->with('success', "You saved inspector <b>{$inspector->name}</b>");
    }

    public function show(Inspector $inspector)
    {
        $inspector->load(['inspections.crew', 'inspections.work_order.client', 'inspections.work_order.job']);

        return view('inspectors.show')->with('inspector', $inspector);
    }

    public function edit(Inspector $inspector)
    {
        return view('inspectors.edit')->with('inspector', $inspector);
    }

    public function update(InspectorSaveRequest $request, Inspector $inspector)
    {
        if(! $inspector->fill( $request->validated() )->save() ) {
            return back()->with('danger', 'Error updating inspector, try again please');
        }

        return redirect()->route('inspectors.edit', $inspector)->with('success', "You updated inspector <b>{$inspector->name}</b>");
    }

    public function destroy(Inspector $inspector)
    {
        if(! $inspector->delete() ) {
            return back()->with('danger', 'Error deleting inspector, try again please');
        }

        return redirect()->route('inspectors.index')->with('success', "You deleted inspector <b>{$inspector->name}</b>");
    }
}
