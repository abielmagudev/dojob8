<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssessmentStoreRequest;
use App\Http\Requests\AssessmentUpdateRequest;
use App\Models\Assessment;
use App\Models\Assessment\Kernel\StatusCatalog;
use App\Models\Client;
use App\Models\Contractor;
use Illuminate\Http\Request;

class AssessmentController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Assessment::class, 'assessment');
    }

    public function index(Request $request)
    {
        $assessments = Assessment::withCount('work_orders')
        ->withEssentialRelationships()
        ->filterByParameters( $request->all() )
        ->where('scheduled_date', now()->format('Y-m-d'))
        ->orderBy('scheduled_date', $request->get('sort', 'desc'))
        ->orderByRaw('ordered IS NULL, ordered asc')
        ->orderByDesc('id')
        ->paginate(35)
        ->appends( $request->query() );

        return view('assessments.index', [
            'assessments' => $assessments,
        ]);
    }

    public function create(Request $request)
    {
        $client = Client::findOrFail( $request->client );

        return view('assessments.create', [
            'assessment' => new Assessment,
            'contractors' => Contractor::all(),
            'client' => $client,
        ]);
    }

    public function store(AssessmentStoreRequest $request)
    {
        if(! $assessment = Assessment::create( $request->validated() ) ) {
            return back()->with('danger', 'Error creating assessment, try again please...');
        }

        return redirect()->route('assessments.index')->with('success', "Assessment <b>{$assessment->id}</b> created");
    }

    public function show(Assessment $assessment)
    {
        $assessment->load('work_orders.job');
        
        return view('assessments.show', [
            'assessment' => $assessment,
        ]);
    }

    public function edit(Assessment $assessment)
    {
        return view('assessments.edit', [
            'assessment' => $assessment,
            'contractors' => Contractor::all(),
            'client' => $assessment->client,
            'statuses' => StatusCatalog::all(),
        ]);
    }

    public function update(AssessmentUpdateRequest $request, Assessment $assessment)
    {
        if(! $assessment->fill( $request->validated() )->save() ) {
            return back()->with('danger', 'Error updating assessment, try again please...');
        }

        return redirect()->route('assessments.edit', $assessment)->with('success', "Assessment <b>{$assessment->id}</b> updated");
    }

    public function destroy(Assessment $assessment)
    {
        if(! $assessment->delete() ) {
            return back()->with('danger', 'Error deleting assessment, try again please...');
        }

        return redirect()->route('assessments.index')->with('success', "Assessment <b>{$assessment->id}</b> deleted");
    }
}
