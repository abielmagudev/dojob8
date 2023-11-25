<?php

namespace App\Http\Controllers;

use App\Http\Requests\CrewSaveRequest;
use App\Models\Crew;
use Illuminate\Http\Request;

class CrewController extends Controller
{
    public function index()
    {
        return view('crews.index', [
            'crews' => Crew::orderBy('name', 'asc')->get(),
        ]);
    }

    public function create()
    {        
        return view('crews.create', [
            'crew' => new Crew,
        ]);
    }

    public function store(CrewSaveRequest $request)
    {
        if(! $crew = Crew::create( $request->validated() ) ) {
            return back()->with('danger', 'Error saving crew, try again please');
        }

        return redirect()->route('crews.index')->with('success', "You saved the crew <b>{$crew->name}</b>");
    }

    public function show(Crew $crew)
    {
        $previous = Crew::before($crew->id)->first();
        $next = Crew::after($crew->id)->first();

        return view('crews.show', [
            'crew' => $crew,
            'routes' => [
                'previous' => $previous ? route('crews.show', $previous) : false,
                'next' => $next ? route('crews.show', $next) : false,
            ],
        ]);
    }

    public function edit(Crew $crew)
    {
        return view('crews.edit', [
            'crew' => $crew,
            'members' => [],
        ]);
    }

    public function update(CrewSaveRequest $request, Crew $crew)
    {
        if(! $crew->fill( $request->validated() )->save() ) {
            return back()->with('danger', 'Error updating crew, try again please');
        }

        return redirect()->route('crews.edit', $crew)->with('success', "You updated the crew <b>{$crew->name}</b>");
    }

    public function destroy(Crew $crew)
    {
        if(! $crew->delete() ) {
            return back()->with('danger', "Error deleting crew, try again please");
        }

        return redirect()->route('crews.index')->with('success', "You deleted the crew <b>{$crew->name}</b>");
    }
}
