<?php

namespace App\Apix\WeatherizationMeasureCps\Controllers;

use App\Apix\Kernel\ResourcesTrait;
use App\Apix\WeatherizationMeasureCps\Models\WeatherizationMeasureCps;
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

    public function edit(Extension $extension, Order $order)
    {
        return $this->view('orders/edit', [
            'extension' => $extension,
            'products' => WeatherizationMeasureCps::all(),
        ]); 
    }
}
