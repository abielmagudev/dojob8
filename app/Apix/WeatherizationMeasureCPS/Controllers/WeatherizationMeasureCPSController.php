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
        $next_item_price_id = (WeatherizationMeasureCps::all())->max('item_price_id') + 1;

        return $this->view('create', [
            'extension' => $extension,
            'measure' => new WeatherizationMeasureCps,
            'next_item_price_id' => $next_item_price_id, 
        ]);
    }

    public function store(MeasureSaveRequest $request, Extension $extension)
    {
        if(! $measure = WeatherizationMeasureCps::create($request->all()) )
            return back()->with('danger', 'Error adding measure, please try again...');

        return redirect()->route('extensions.show', $extension)->with('success', "Measure <b>{$measure->name}</b> saved");
    }

    public function edit(Request $request, Extension $extension)
    {
        $measure = WeatherizationMeasureCps::findOrFail($request->measure);

        return $this->view('edit', [
            'extension' => $extension,
            'measure' => $measure,
            'next_item_price_id' => $measure->item_price_id,
        ]);
    }

    public function update(MeasureSaveRequest $request, Extension $extension)
    {
        $measure = WeatherizationMeasureCps::findOrFail($request->measure);

        if(! $measure->fill( $request->all() )->save() )
            return back()->with('danger', 'Error updating measure, please try again...');

        return redirect()->route('extensions.edit', [$extension, 'measure' => $measure->id])->with('success', "Measure <b>{$measure->name}</b> updated");
    }

    public function destroy(Request $request, Extension $extension)
    {
        $measure = WeatherizationMeasureCps::findOrFail($request->measure);

        if(! $measure->delete() )
            return back()->with('danger', 'Error deleting measure, please try again...');

        return redirect()->route('extensions.show', $extension)->with('success', "Measure <b>{$measure->name}</b> deleted");
    }
}
