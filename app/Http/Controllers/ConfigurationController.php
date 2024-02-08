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
    public function index(Request $request)
    {
        return view('configuration.index')->with('configuration', Configuration::first());
    }

    public function update(ConfigurationSaveRequest $request)
    {        
        $configuration = Configuration::first();

        if(! $configuration->fill( $request->validated() )->save() ) {
            return back()->with('danger', 'Error updating configuration, try again please');
        }

        return redirect()->route('configuration.index')->with('success', "You updated configuration");
    }
}
