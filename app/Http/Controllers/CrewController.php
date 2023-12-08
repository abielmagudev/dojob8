<?php

namespace App\Http\Controllers;

use App\Http\Requests\CrewSaveRequest;
use App\Http\Requests\CrewMemberUpdateRequest;
use App\Models\Crew;
use App\Models\Crew\CrewPainter;
use App\Models\Member;
use Illuminate\Http\Request;

class CrewController extends Controller
{
    public function index(Request $request)
    {
        return view('crews.index', [
            'crews' => Crew::with(['members', 'work_orders'])->whereActive( $request->get('active', 1) )->orderBy('name')->get(),
            'show' => in_array($request->get('show'), ['grid', 'table']) ? $request->get('show') : 'grid',
            'request' => $request,
            'members' => Member::onlyCanBeInCrews()->orderBy('name')->get(),
        ]);
    }

    public function create()
    {        
        return view('crews.create', [
            'crew' => new Crew,
            'text_color_modes_colors' => CrewPainter::getTextColorModesAndColors(),
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
            'members' => Member::onlyCanBeInCrews()->orderBy('name')->get(),
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
            'text_color_modes_colors' => CrewPainter::getTextColorModesAndColors(),
        ]);
    }

    public function update(CrewSaveRequest $request, Crew $crew)
    {
        if(! $crew->fill( $request->validated() )->save() ) {
            return back()->with('danger', 'Error updating crew, try again please');
        }

        if( $crew->isInactive() ) {
            $crew->removeMembers();
        }

        return redirect()->route('crews.edit', $crew)->with('success', "You updated the crew <b>{$crew->name}</b>");
    }

    public function destroy(Crew $crew)
    {
        if(! $crew->delete() ) {
            return back()->with('danger', "Error deleting crew, try again please");
        }

        $crew->removeMembers();

        return redirect()->route('crews.index')->with('success', "You deleted the crew <b>{$crew->name}</b>");
    }

    public function membersUpdate(CrewMemberUpdateRequest $request, Crew $crew)
    {
        $crew->removeMembers();

        if( $request->filled('members') ) {
            $crew->addMembers($request->members);
        }

        if($request->ajax() || $request->wantsJson() || $request->header('X-Requested-With') === 'XMLHttpRequest')
        {
            $members = $crew->members->only($request->members)->map(fn($member) => ['name' => $member->full_name]);
            return response()->json([
                'message' => sprintf('You updated the members %s in the %s crew', $members->implode(', '), $crew->name),
                'status' => 200,
                'dataset' => $crew->dataset_json,
            ]);
        }

        return redirect()->route('crews.index', ['show' => $request->get('show', 'grid')])->with('success', "You updated the members of the <b>{$crew->name}</b> crew");
    }
}
