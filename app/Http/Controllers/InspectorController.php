<?php

namespace App\Http\Controllers;

use App\Http\Requests\InspectorSaveRequest;
use App\Models\Inspector;
use Illuminate\Http\Request;

class InspectorController extends Controller
{
    public function index()
    {
        return view('inspectors.index', [
            'inspectors' => Inspector::orderBy('name')->paginate(25),
        ]);
    }

    public function create()
    {
        return view('inspectors.create', [
            'inspector' => new Inspector,
        ]);
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
        return view('inspectors.show', [
            'inspector' => $inspector,
        ]);
    }

    public function edit(Inspector $inspector)
    {
        return view('inspectors.edit', [
            'inspector' => $inspector,
        ]);
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
