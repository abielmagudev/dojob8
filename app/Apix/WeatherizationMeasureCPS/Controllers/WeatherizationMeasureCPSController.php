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
            'products' => WeatherizationMeasureCps::all(),
        ]);
    }

    public function create(Request $request, Extension $extension)
    {
        return $this->view('create', [
            'extension' => $extension,
            'products' => WeatherizationMeasureCps::all(),
        ]);
    }

    public function store(MeasureSaveRequest $request, Extension $extension)
    {
        if(! $product = WeatherizationMeasureCps::create($request->all()) )
            return back()->with('danger', 'Error adding product, please try again...');

        return redirect()->route('extensions.index')->with('success', "Product {$product->name} added");
    }

    public function edit(Request $request, Extension $extension)
    {
        $product = WeatherizationMeasureCps::findOrFail($request->product);

        return $this->view('edit', [
            'extension' => $extension,
            'products' => WeatherizationMeasureCps::all(),
            'product' => $product,
        ]);
    }

    public function update(Request $request, Extension $extension)
    {
        $product = WeatherizationMeasureCps::findOrFail($request->product);

        if(! $product->fill( $request->all() )->save() )
            return back()->with('danger', 'Error updating product, please try again...');

        return redirect()->route('extensions.edit', [$extension, 'product' => $product->id])->with('success', "Product {$product->name} updated");
    }

    public function destroy(Request $request, Extension $extension)
    {
        $product = WeatherizationMeasureCps::findOrFail($request->product);

        if(! $product->delete() )
            return back()->with('danger', 'Error deleting product, please try again...');

        return redirect()->route('extensions.show', $extension)->with('success', "Product {$product->name} deleted");
    }
}
