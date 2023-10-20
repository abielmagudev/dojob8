<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobSaveRequest;
use App\Models\Extension;
use App\Models\Job;

class JobController extends Controller
{
    public function index()
    {
        return view('jobs.index')->with('jobs', 
            Job::withCount(['extensions'])
            ->orderBy('name')
            ->get()
        );
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
        return view('jobs.show', [
            'extensions' => Extension::whereNotIn('id', $job->extensions->pluck('id'))->orderBy('name')->get(),
            'job' => $job,
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
