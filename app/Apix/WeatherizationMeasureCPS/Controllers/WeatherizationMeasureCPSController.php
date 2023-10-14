<?php

namespace App\Apix\WeatherizationMeasureCPS\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Extension;
use Illuminate\Http\Request;
use App\Apix\Kernel\ResourcesTrait;
use App\Apix\WeatherizationMeasureCPS\Models\WeatherizationMeasureCPSProduct;

class WeatherizationMeasureCPSController extends Controller
{
    use ResourcesTrait;

    public function show(Request $request, Extension $extension)
    {
        return $this->view('show', [
            'extension' => $extension,
            'products' => WeatherizationMeasureCPSProduct::all(),
        ]);
    }

    public function create(Request $request, Extension $extension)
    {
        return $this->view('create', [
            'extension' => $extension,
            'products' => WeatherizationMeasureCPSProduct::all(),
        ]);
    }

    public function store(Request $request, Extension $extension)
    {
        if(! $product = WeatherizationMeasureCPSProduct::create($request->all()) )
            return back()->with('danger', 'Error adding product, please try again...');

        return redirect()->route('extensions.index')->with('success', "Product {$product->name} added");
    }

    public function edit(Request $request, Extension $extension)
    {
        $product = WeatherizationMeasureCPSProduct::findOrFail($request->product);

        return $this->view('edit', [
            'extension' => $extension,
            'products' => WeatherizationMeasureCPSProduct::all(),
            'product' => $product,
        ]);
    }

    public function update(Request $request, Extension $extension)
    {
        $product = WeatherizationMeasureCPSProduct::findOrFail($request->product);

        if(! $product->fill( $request->all() )->save() )
            return back()->with('danger', 'Error updating product, please try again...');

        return redirect()->route('extensions.edit', [$extension, 'product' => $product->id])->with('success', "Product {$product->name} updated");
    }

    public function destroy(Request $request, Extension $extension)
    {
        $product = WeatherizationMeasureCPSProduct::findOrFail($request->product);

        if(! $product->delete() )
            return back()->with('danger', 'Error deleting product, please try again...');

        return redirect()->route('extensions.show', $extension)->with('success', "Product {$product->name} deleted");
    }
}
