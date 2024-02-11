<?php

namespace App\Http\Controllers;

use App\Http\Requests\AgencySaveRequest;
use App\Models\Agency;

class AgencyController extends Controller
{
    public function index()
    {
        return view('agencies.index', [
            'agencies' => Agency::with(['inspections'])->orderBy('id')->get(),
        ]);
    }

    public function create()
    {
        return view('agencies.create')->with('agency', new Agency());
    }

    public function store(AgencySaveRequest $request)
    {
        if(! $agency = Agency::create( $request->validated() ) ) {
            return back()->with('danger', "Error creating agency, try again please");
        }

        return redirect()->route('agencies.index')->with('success', sprintf('You created a new agency <b>%s</b>', $agency->name));
    }

    public function show(Agency $agency)
    {
        $agency->load('inspections');
        return view('agencies.show')->with('agency', $agency);
    }

    public function edit(Agency $agency)
    {
        return view('agencies.edit')->with('agency', $agency);
    }

    public function update(AgencySaveRequest $request, Agency $agency)
    {
        if(! $agency->fill( $request->validated() )->save() ) {
            return back()->with('danger', "Error updating agency, try again please");
        }

        return redirect()->route('agencies.edit', $agency)->with('success', sprintf('You updated agency <b>%s</b>', $agency->name));
    }

    public function destroy(Agency $agency)
    {
        if(! $agency->delete() ) {
            return back()->with('danger', "Error deleting agency, try again please");
        }

        return redirect()->route('agencies.index')->with('success', sprintf('You deleted agency <b>%s</b>', $agency->name));
    }
}
