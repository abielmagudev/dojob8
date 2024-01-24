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
            'members' => Member::whereIsCrewMember()->available()->orderBy('name')->get(),
        ]);
    }

    public function create()
    {        
        return view('crews.create', [
            'all_tasks' => Crew::getAllTasks(),
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
        return view('crews.show', [
            'crew' => $crew,
            'members' => Member::whereIsCrewMember()->orderBy('name')->get(),
        ]);
    }

    public function edit(Crew $crew)
    {
        return view('crews.edit', [
            'all_tasks' => Crew::getAllTasks(),
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
            $crew->members()->detach();
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

    /**
     * En esta funcion tiene 2 procesos, cuando la peticion es por AJAX o sincronia de Http.
     * 
     * Si es por Http, significa que varios members seran agregados al crew seleccionado, lo cual
     * NO se removeran los crews que pertenezcan los members recibidos por $request.
     * 
     * Excepto por los que no esten en la peticion, es por eso que se usa la funcion de "sync".
     */
    public function membersUpdate(CrewMemberUpdateRequest $request, Crew $crew)
    {
        if($request->ajax() || $request->wantsJson() || $request->header('X-Requested-With') == 'XMLHttpRequest') {
            return $this->membersUpdateAjaxForKeepOthersCrews($request, $crew);
        }

        $crew->members()->sync( $request->get('members', []) );

        return redirect()->route('crews.index', ['show' => $request->get('show', 'grid')])->with('success', "You updated the members of the <b>{$crew->name}</b> crew");
    }

    /**
     * Esta funcion es cuando se hace con la interaccion de arrastre(dragdrop) 
     * con la libreria "SortableJs" de miembros entre crews.
     * 
     * Aunque la interaccion de arrastre es de uno(1) member, el proceso es mantener
     * los crews al que pertenece el o los members recibidos por request.
     * 
     * Excepto del crew de donde proviene, id del crew en la variable crew_old del request
     */
    public function membersUpdateAjaxForKeepOthersCrews(CrewMemberUpdateRequest $request, Crew $crew)
    {
        // If is null the input "members", return a empty array
        $members_id = $request->get('members', []);

        // Sync members and keep the crews of members
        $crew->members()->sync($members_id);

        // Get the members recent attached by sync
        $members = $crew->members->only($members_id);

        // Get the full names of members attached
        $member_full_names = $members->map(fn($member) => ['full_name' => $member->full_name]);

        // Removes the old crew from the members received in the request
        if( $request->filled('crew_old') ) {
            $members->each(fn($member) => $member->crews()->detach($request->get('crew_old')));
        }

        return response()->json([
            'message' => sprintf('You updated the members %s in the %s crew', $member_full_names->implode(', '), $crew->name),
            'status' => 200,
            'dataset' => $crew->dataset_json,
        ]);
    }

    /**
     * Esta funcion es cuando se hace con la interaccion de arrastre(dragdrop) 
     * con la libreria "SortableJs" de miembros entre crews.
     * 
     * Aunque la interaccion de arrastre es de uno(1) member, esta funcion se encarga de mantener
     * los crews al que pertenece el o los members recibidos por request aun de donde proviene.
     * NO remueve ningun crew
     */
    public function membersUpdateAjaxForKeepCrews(CrewMemberUpdateRequest $request, Crew $crew)
    {
        // If is null the input "members", return a empty array
        $members_id = $request->get('members', []);

        // Sync members and keep the crews of members
        $crew->members()->sync($members_id);

        // Get the full names of members attached
        $member_full_names = $crew->members->only($members_id)->map(fn($member) => ['full_name' => $member->full_name]);

        return response()->json([
            'message' => sprintf('You updated the members %s in the %s crew', $member_full_names->implode(', '), $crew->name),
            'status' => 200,
            'dataset' => $crew->dataset_json,
        ]);
    }


    /**
     * Esta funcion es cuando se hace con la interaccion de arrastre(dragdrop) 
     * con la libreria "SortableJs" de miembros entre crews.
     * 
     * En esta interaccion, solamente se arrastra uno(1) member al crew deseado, por lo que los crews 
     * que tenga el member seran removidos
     */
    public function membersUpdateAjaxForSingleCrew(CrewMemberUpdateRequest $request, Crew $crew)
    {
        // If is null the input "members", return a empty array
        $members_id = $request->get('members', []);

        // Get members from the request to remove crews they belong to
        $members = Member::with('crews')->whereIn('id', $members_id)->get();

        // Remove all crews they belong to
        $members->each(function ($member) { 
            $member->crews()->detach(); 
        });

        // Attach members on current crew
        $crew->members()->attach($members_id);

        // Get the full names of members attached
        $member_full_names = $members->map(function($member) {
            return [
                'full_name' => $member->full_name,
            ];
        });

        return response()->json([
            'message' => sprintf('You updated the members %s in the %s crew', $member_full_names->implode(', '), $crew->name),
            'status' => 200,
            'dataset' => $crew->dataset_json,
        ]);
    }
}
