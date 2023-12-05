<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobSaveRequest;
use App\Models\Extension;
use App\Models\Job;

class JobController extends Controller
{
    public function index()
    {
        return view('jobs.index', [
            'jobs' => Job::with('work_orders')->withCount('extensions')
                        ->orderBy('name')
                        ->paginate(25),
        ]);
    }

    public function create()
    {
        return view('jobs.create')->with('job', new Job);
    }

    public function store(JobSaveRequest $request)
    {
        if(! $job = Job::create( $request->validated() ) )
            return back()->with('danger', 'Error creating job, please try again');

        return redirect()->route('jobs.index')->with('success', "You created job <b>{$job->name}</b>");
    }

    public function show(Job $job)
    {
        $previous = Job::before($job->id)->first();
        $next = Job::after($job->id)->first();

        return view('jobs.show', [
            'extensions' => Extension::whereNotIn('id', $job->extensions->pluck('id'))->orderBy('name')->get(),
            'job' => $job->load(['extensions', 'work_orders']),
            'routes' => [
                'previous' => $previous ? route('jobs.show', $previous) : false,
                'next' => $next ? route('jobs.show', $next) : false,
            ],
        ]);
    }

    public function edit(Job $job)
    {
        return view('jobs.edit', [
            'extensions' => Extension::all()->sortBy('name'),
            'job' => $job,
        ]);
    }

    public function update(JobSaveRequest $request, Job $job)
    {
        if(! $job->fill( $request->validated() )->save() )
            return back()->with('danger', 'Error updating job, please try again'); 

        return redirect()->route('jobs.edit', $job)->with('success', "You updated job <b>{$job->name}</b>");
    }

    public function destroy(Job $job)
    {
        if(! $job->delete() )
            return back()->with('danger', 'Error deleting job, please try again');

        return redirect()->route('jobs.index')->with('success', "You deleted job <b>{$job->name}</b>");
    }
}
