<?php

namespace App\Apix\WeatherizationMeasureCps\Controllers;

use App\Apix\WeatherizationMeasureCps\Models\WeatherizationMeasureCps;
use App\Apix\WeatherizationMeasureCps\Models\WeatherizationProductCpsOrder;
use App\Apix\WeatherizationMeasureCps\Requests\ProductOrderSaveRequest;
use App\Http\Controllers\Controller;
use App\Models\Extension;
use App\Models\Order;
use Illuminate\Http\Request;

class WeatherizationMeasureCpsOrderController extends Controller
{
    private function save(Request $request, Order $order)
    {
        $products_count = count( $request->products );

        $data = [];

        for($i = 0; $i < $products_count; $i++)
        {
            array_push($data, [
                'quantity' => $request->quantities[$i] ?? 0,
                'measure_id' => $request->products[$i],
                'order_id' => $order->id,
                'created_at' => now(),
            ]);
        }

        return WeatherizationProductCpsOrder::insert($data);
    }

    public function create(Extension $extension)
    {
        return view('WeatherizationMeasureCps/resources/views/orders/create', [
            'extension' => $extension,
            'products' => WeatherizationMeasureCps::available()->get(['id', 'name']),
        ]);
    }

    public function store(ProductOrderSaveRequest $request, Order $order)
    {
        if( is_null($request->products) ) {
            return true;
        }

        return $this->save($request, $order);
    }

    public function edit(Extension $extension, Order $order)
    {
        return view('WeatherizationMeasureCps/resources/views/orders/edit', [
            'extension' => $extension,
            'products' => WeatherizationMeasureCps::available()->get(['id', 'name']),
            'products_order' => WeatherizationProductCpsOrder::with('measure')->whereOrder($order->id)->get(),
        ]); 
    }

    public function update(ProductOrderSaveRequest $request, Order $order)
    {
        WeatherizationProductCpsOrder::whereOrder($order->id)->delete();

        if( is_null($request->products) ) {
            return true;
        }

        return $this->save($request, $order);
    }

    public function destroy(WeatherizationProductCpsOrder $product)
    {
        //   
    }
}
