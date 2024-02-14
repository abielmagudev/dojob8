<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingsSaveRequest;
use App\Models\Settings;
use Illuminate\Http\Request;

/**
 * ViewServiceProvider
 * 
 * View::share('settings', Settings::first());
 */

class SettingsController extends Controller
{
    public function index(Request $request)
    {
        return view('settings.index')->with('settings', Settings::first());
    }

    public function update(SettingsSaveRequest $request)
    {        
        $settings = Settings::first();

        if(! $settings->fill( $request->validated() )->save() ) {
            return back()->with('danger', 'Error updating settings, try again please');
        }

        return redirect()->route('settings.index')->with('success', "You updated settings");
    }
}
