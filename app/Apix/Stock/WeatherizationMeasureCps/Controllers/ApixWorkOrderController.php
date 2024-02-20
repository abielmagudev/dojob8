<?php

namespace App\Apix\Stock\WeatherizationMeasureCps\Controllers;

use App\Apix\Stock\WeatherizationMeasureCps\Models\WeatherizationMeasureCps;
use App\Apix\Stock\WeatherizationMeasureCps\Models\WeatherizationProductCpsWorkOrder;
use App\Apix\Stock\WeatherizationMeasureCps\Requests\ProductWorkOrderSaveRequest;
use App\Http\Controllers\Controller;
use App\Models\Extension;
use App\Models\WorkOrder;
use Illuminate\Http\Request;

class ApixWorkOrderController extends Controller
{
    private function save(Request $request, WorkOrder $work_order)
    {
        $products_count = count( $request->products );

        $data = [];

        for($i = 0; $i < $products_count; $i++)
        {
            array_push($data, [
                'quantity' => $request->quantities[$i] ?? 0,
                'measure_id' => $request->products[$i],
                'work_order_id' => $work_order->id,
                'created_at' => now(),
            ]);
        }

        return WeatherizationProductCpsWorkOrder::insert($data);
    }

    public function create(Extension $extension)
    {
        return view('WeatherizationMeasureCps/resources/views/work-orders/create', [
            'extension' => $extension,
            'products' => WeatherizationMeasureCps::available()->get(['id', 'name']),
        ]);
    }

    public function store(ProductWorkOrderSaveRequest $request, WorkOrder $work_order)
    {
        if( is_null($request->products) ) {
            return true;
        }

        return $this->save($request, $work_order);
    }

    public function edit(Extension $extension, WorkOrder $work_order)
    {
        return view('WeatherizationMeasureCps/resources/views/work-orders/edit', [
            'extension' => $extension,
            'products' => WeatherizationMeasureCps::available()->get(['id', 'name']),
            'work_order_products' => WeatherizationProductCpsWorkOrder::with('measure')->whereWorkOrder($work_order->id)->get(),
        ]); 
    }

    public function update(ProductWorkOrderSaveRequest $request, WorkOrder $work_order)
    {
        WeatherizationProductCpsWorkOrder::whereWorkOrder($work_order->id)->delete();

        if( is_null($request->products) ) {
            return true;
        }

        return $this->save($request, $work_order);
    }

    public function destroy(WeatherizationProductCpsWorkOrder $product)
    {
        //   
    }
}
