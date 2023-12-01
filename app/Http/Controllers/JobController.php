<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobSaveRequest;
use App\Models\Extension;
use App\Models\Job;
use App\Models\WorkOrder;

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
            return back()->with('danger', 'Job was not created, please try again');

        return redirect()->route('jobs.index')->with('success', "Job <b>{$job->name}</b> created");
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
            return back()->with('danger', 'Job was not updated, please try again'); 

        return redirect()->route('jobs.edit', $job)->with('success', "Job <b>{$job->name}</b> updated");
    }

    public function destroy(Job $job)
    {
        if(! $job->delete() )
            return back()->with('danger', 'Job was not deleted, please try again');

        return redirect()->route('jobs.index')->with('success', "Job <b>{$job->name}</b> deleted");
    }
}
