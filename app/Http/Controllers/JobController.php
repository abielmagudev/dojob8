<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobSaveRequest;
use App\Models\Agency;
use App\Models\Extension;
use App\Models\Job;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::withCount(['incomplete_work_orders', 'extensions'])
        ->orderBy('name')
        ->paginate(25);

        return view('jobs.index', [
            'jobs' => $jobs,
        ]);
    }

    public function create()
    {
        return view('jobs.create', [
            'agencies' => Agency::all()->sortBy('name'),
            'job' => new Job,
        ]);
    }

    public function store(JobSaveRequest $request)
    {
        if(! $job = Job::create( $request->validated() ) ) {
            return back()->with('danger', 'Error creating job, please try again');
        }

        return redirect()->route('jobs.show', $job)->with('success', "You created job <b>{$job->name}</b>");
    }

    public function show(Job $job)
    {
        return view('jobs.show', [
            'extensions' => Extension::whereNotIn('id', $job->extensions->pluck('id'))->orderBy('name')->get(),
            'job' => $job->load(['extensions', 'work_orders']),
        ]);
    }

    public function edit(Job $job)
    {
        return view('jobs.edit', [
            'agencies' => Agency::all()->sortBy('name'),
            'job' => $job,
        ]);
    }

    public function update(JobSaveRequest $request, Job $job)
    {
        if(! $job->fill( $request->validated() )->save() ) {
            return back()->with('danger', 'Error updating job, please try again'); 
        }

        return redirect()->route('jobs.edit', $job)->with('success', "You updated job <b>{$job->name}</b>");
    }

    public function destroy(Job $job)
    {
        if(! $job->delete() ) {
            return back()->with('danger', 'Error deleting job, please try again');
        }

        return redirect()->route('jobs.index')->with('success', "You deleted job <b>{$job->name}</b>");
    }
}
