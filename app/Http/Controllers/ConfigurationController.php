<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConfigurationSaveRequest;
use App\Models\Configuration;
use Illuminate\Http\Request;

/**
 * ViewServiceProvider
 * 
 * View::share('configuration', Configuration::first());
 */

class ConfigurationController extends Controller
{
    public function index()
    {
        return view('configuration.index');
    }

    // public function create()
    // {
    //     // 
    // }

    // public function store(Request $request)
    // {
    //     //
    // }

    // public function show(Configuration $configuration)
    // {
    //     //
    // }

    public function edit(Configuration $configuration)
    {
        return view('configuration.edit');
    }

    public function update(ConfigurationSaveRequest $request, Configuration $configuration)
    {
        if(! $configuration->fill( $request->validated() )->save() ) {
            return back()->with('danger', 'Error updating configuration, try again please');
        }

        return redirect()->route('configuration.edit', $configuration)->with('success', "You updated configuration");
    }

    // public function destroy(Configuration $configuration)
    // {
    //     //
    // }
}
