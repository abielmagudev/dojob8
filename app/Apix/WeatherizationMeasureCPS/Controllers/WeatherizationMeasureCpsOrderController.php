<?php

namespace App\Apix\WeatherizationMeasureCps\Controllers;

use App\Apix\Kernel\ResourcesTrait;
use App\Apix\WeatherizationMeasureCps\Models\WeatherizationMeasureCps;
use App\Apix\WeatherizationMeasureCps\Models\WeatherizationMeasureCpsOrder;
use App\Apix\WeatherizationMeasureCps\Requests\OrderMeasureSaveRequest;
use App\Http\Controllers\Controller;
use App\Models\Extension;
use App\Models\Order;
use Illuminate\Http\Request;

class WeatherizationMeasureCpsOrderController extends Controller
{
    use ResourcesTrait;

    public function create(Extension $extension)
    {
        return $this->view('orders/create', [
            'extension' => $extension,
            'products' => WeatherizationMeasureCps::all(),
        ]);
    }

    public function store(OrderMeasureSaveRequest $request, Order $order)
    {
        if( is_null($request->get('measures')) )
        {
            session()->flash('success', 'Weatherization Measure CPS empty');
            return true;
        }

        return $this->insertData($request, $order);
    }

    public function edit(Extension $extension, Order $order)
    {
        return view('WeatherizationMeasureCps/resources/views/orders/edit', [
            'extension' => $extension,
            'products' => WeatherizationMeasureCps::all(),
        ]); 
    }

    public function update(OrderMeasureSaveRequest $request, Order $order)
    {
        $this->destroyByOrder($order);

        if( is_null($request->get('measures')) )
        {
            session()->flash('success', 'Weatherization Measure CPS empty');
            return true;
        }

        return $this->insertData($request, $order);
    }

    public function insertData(Request $request, $order)
    {
        $data = [];

        $measures_count = count($request->measures);
        
        for($i = 0; $i < $measures_count; $i++)
        {
            array_push($data, [
                'quantity' => $request->quantities[$i],
                'measure_id' => $request->measures[$i],
                'order_id' => $order->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return WeatherizationMeasureCpsOrder::insert($data);
    }

    public function destroyByOrder(Order $order)
    {
        return WeatherizationMeasureCpsOrder::where('order_id', $order->id)->delete();
    }

    public function destroy()
    {
        
    }
}
