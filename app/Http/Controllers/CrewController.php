<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CrewController\IndexTemplate;
use App\Http\Requests\CrewSaveRequest;
use App\Models\Crew;
use App\Models\Member;
use Illuminate\Http\Request;

class CrewController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Crew::class, 'crew');
    }

    public function index(Request $request)
    {
        // $crews = Crew::with('members')
        // ->withCount(['incomplete_work_orders', 'pending_inspections'])
        // ->orderBy('name')
        // ->get();

        $crews = Crew::with('members')->orderBy('name')->get();

        return view('crews.index', [
            'active_crews' => $crews->filter(fn($crew) => $crew->isActive()),
            'crews' => $crews,
            'members' => Member::available()->crewMember()->orderBy('name')->get(),
            'request' => $request,
            'template' => IndexTemplate::get( $request->get('template') ),
        ]);
    }

    public function create()
    {        
        return view('crews.create', [
            'all_purposes' => Crew::collectionAllPurposes(),
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
        return view('crews.show')->with('crew', $crew);
    }

    public function edit(Crew $crew)
    {
        return view('crews.edit', [
            'all_purposes' => Crew::collectionAllPurposes(),
            'crew' => $crew,
        ]);
    }

    public function update(CrewSaveRequest $request, Crew $crew)
    {
        if(! $crew->fill( $request->validated() )->save() ) {
            return back()->with('danger', 'Error updating crew, try again please');
        }

        if( $crew->isInactive() ) {
            $crew->members()->detach();
        }

        return redirect()->route('crews.edit', $crew)->with('success', "You updated the crew <b>{$crew->name}</b>");
    }

    public function destroy(Crew $crew)
    {
        if(! $crew->delete() ) {
            return back()->with('danger', "Error deleting crew, try again please");
        }

        $crew->members()->detach();

        return redirect()->route('crews.index')->with('success', "You deleted the crew <b>{$crew->name}</b>");
    }
}
