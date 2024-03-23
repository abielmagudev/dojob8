<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AssessmentController\Index\RequestInitializer;
use App\Http\Requests\AssessmentStoreRequest;
use App\Http\Requests\AssessmentUpdateRequest;
use App\Models\Assessment;
use App\Models\Assessment\Kernel\StatusCatalog;
use App\Models\Client;
use App\Models\Contractor;
use App\Models\Crew;
use App\Models\Media\Services\MediaFileDestroyer;
use Illuminate\Http\Request;

class AssessmentController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Assessment::class, 'assessment');
    }

    public function index(Request $request)
    {
        $request = RequestInitializer::init($request);

        $assessments = Assessment::withCount('work_orders')
        ->withEssentialRelationships()
        ->filterByParameters( $request->all() )
        ->orderBy('scheduled_date', $request->get('sort', 'desc'))
        ->orderByRaw('ordered IS NULL, ordered asc')
        ->orderByDesc('id')
        ->paginate(35)
        ->appends( $request->query() );

        return view('assessments.index', [
            'assessments' => $assessments,
            'crews' => Crew::all(),
            'contractors' => Contractor::all(),
        ]);
    }

    public function create(Request $request)
    {
        $client = Client::findOrFail( $request->client );

        return view('assessments.create', [
            'assessment' => new Assessment,
            'client' => $client,
            'contractors' => Contractor::all(),
            'crews' => Crew::task('assessments')->get(),
        ]);
    }

    public function store(AssessmentStoreRequest $request)
    {
        if(! $assessment = Assessment::create( $request->validated() ) ) {
            return back()->with('danger', 'Error creating assessment, try again please...');
        }

        if( $assessment->hasCrew() )
        {
            $assessment->member()->attach(
                $assessment->crew->members
            );
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
            'client' => $assessment->client,
            'contractors' => Contractor::all(),
            'crews' => Crew::task('assessments')->get(),
            'statuses' => Assessment::statuses(),
        ]);
    }

    public function update(AssessmentUpdateRequest $request, Assessment $assessment)
    {
        if(! $assessment->fill( $request->validated() )->save() ) {
            return back()->with('danger', 'Error updating assessment, try again please...');
        }

        if( $request->filled('reassign_crew_members') )
        {
            if( $assessment->hasCrew() )
            {
                $assessment->members()->sync(
                    $assessment->crew->members
                );
            }
            else
            {
                $assessment->members()->detach();
            }
        }

        return redirect()->route('assessments.edit', $assessment)->with('success', "Assessment <b>{$assessment->id}</b> updated");
    }

    public function destroy(Assessment $assessment)
    {
        $media = $assessment->media;

        if(! $assessment->delete() ) {
            return back()->with('danger', 'Error deleting assessment, try again please...');
        }

        foreach($media as $file) {
            MediaFileDestroyer::delete($file);
        }

        $assessment->media()->delete();

        $assessment->history()->delete();

        return redirect()->route('assessments.index')->with('success', "Assessment <b>{$assessment->id}</b> deleted");
    }
}
