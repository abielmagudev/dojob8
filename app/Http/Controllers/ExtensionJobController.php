<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExtensionJobRequest;
use App\Models\Extension;
use App\Models\Job;

class ExtensionJobController extends Controller
{
    public function attach(ExtensionJobRequest $request, Job $job)
    {
        $job->extensions()->attach($request->extension, [
            'tidy' => ($job->extensions->count() + 1),
        ]);

        // Reload extensions after attached
        $job->load('extensions');

        if(! $extension = $job->extensions->firstWhere('id', $request->extension) )
            return back()->with('danger', 'Error on adding extension, try again please');

        return redirect()->route('jobs.show', $job)->with('success', "Extension <b>{$extension->name}</b> added");
    }

    public function detach(ExtensionJobRequest $request, Job $job)
    {
        $job->extensions()->detach($request->extension);

        if( $job->extensions->contains('id', $request->extension) )
            return back()->with('danger', 'Error on removing extension, try again please');

        $extension = Extension::find($request->extension) ?? json_encode(['name' => 'unknown']);

        return redirect()->route('jobs.show', $job)->with('success', "Extension <b>{$extension->name}</b> removed");
    }
}
