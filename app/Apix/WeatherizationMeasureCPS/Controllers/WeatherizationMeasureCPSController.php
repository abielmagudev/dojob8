<?php

namespace App\Apix\WeatherizationMeasureCps\Controllers;

use App\Apix\Kernel\ResourcesTrait;
use App\Apix\WeatherizationMeasureCps\Models\WeatherizationMeasureCps;
use App\Apix\WeatherizationMeasureCps\Requests\MeasureSaveRequest;
use App\Http\Controllers\Controller;
use App\Models\Extension;
use Illuminate\Http\Request;

class WeatherizationMeasureCpsController extends Controller
{
    use ResourcesTrait;

    public function show(Request $request, Extension $extension)
    {
        return $this->view('show', [
            'extension' => $extension,
            'measures' => WeatherizationMeasureCps::all(),
        ]);
    }

    public function create(Request $request, Extension $extension)
    {
        $measures = WeatherizationMeasureCps::all();
        return $this->view('create', [
            'extension' => $extension,
            'measures' => $measures,
            'next_item_price_id' => ($measures->max('item_price_id') + 1), 
        ]);
    }

    public function store(MeasureSaveRequest $request, Extension $extension)
    {
        if(! $measure = WeatherizationMeasureCps::create($request->all()) )
            return back()->with('danger', 'Error adding measure, please try again...');

        return redirect()->route('extensions.show', $extension)->with('success', "Measure {$measure->name} added");
    }

    public function edit(Request $request, Extension $extension)
    {
        $measure = WeatherizationMeasureCps::findOrFail($request->measure);

        return $this->view('edit', [
            'extension' => $extension,
            'measures' => WeatherizationMeasureCps::all(),
            'measure' => $measure,
        ]);
    }

    public function update(Request $request, Extension $extension)
    {
        $measure = WeatherizationMeasureCps::findOrFail($request->measure);

        if(! $measure->fill( $request->all() )->save() )
            return back()->with('danger', 'Error updating measure, please try again...');

        return redirect()->route('extensions.edit', [$extension, 'measure' => $measure->id])->with('success', "Measure {$measure->name} updated");
    }

    public function destroy(Request $request, Extension $extension)
    {
        $measure = WeatherizationMeasureCps::findOrFail($request->measure);

        if(! $measure->delete() )
            return back()->with('danger', 'Error deleting measure, please try again...');

        return redirect()->route('extensions.show', $extension)->with('success', "Measure {$measure->name} deleted");
    }
}
