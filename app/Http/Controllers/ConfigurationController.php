<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConfigurationUpdateRequest;
use App\Models\Configuration;

/**
 * ViewServiceProvider
 * 
 * View::share('configuration', Configuration::singleton());
 */

class ConfigurationController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Configuration::class, 'configuration');        
    }

    public function index()
    {
        return view('configuration.index')->with('configuration', Configuration::singleton());
    }

    public function update(ConfigurationUpdateRequest $request)
    {        
        $configuration = Configuration::singleton();

        if(! $configuration->fill( $request->validated() )->save() ) {
            return back()->with('danger', 'Error updating configuration, try again please');
        }

        $configuration->refresh();

        return redirect()->route('configuration.index')->with('success', "Configuration updated");
    }
}
