<?php

namespace App\Apix\CpsProductMeasures\Controllers;

use App\Apix\CpsProductMeasures\Models\Category;
use App\Apix\CpsProductMeasures\Models\CpsProductMeasureOrder;
use App\Apix\CpsProductMeasures\Models\Product;
use App\Apix\CpsProductMeasures\Requests\ProductOrderSaveRequest;
use App\Http\Controllers\Controller;
use App\Models\Extension;
use App\Models\Order;
use Illuminate\Http\Request;

class CpsProductMeasuresOrderController extends Controller
{
    private function save(Request $request, Order $order)
    {
        $products_count = count( $request->products );

        $data = [];

        for($i = 0; $i < $products_count; $i++)
        {
            array_push($data, [
                'quantity' => $request->quantities[$i] ?? 0,
                'product_id' => $request->products[$i],
                'order_id' => $order->id,
                'created_at' => now(),
            ]);
        }

        return CpsProductMeasureOrder::insert($data);
    }

    public function create(Extension $extension)
    {
        return view('CpsProductMeasures/views/orders/create', [
            'extension' => $extension,
            'categories' => Category::with('products')->get(),
            'products' => Product::available()->get(['id', 'name']),
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
        return view('CpsProductMeasures/views/orders/edit', [
            'extension' => $extension,
            'categories' => Category::with('products')->get(),
            'products' => Product::available()->get(['id', 'name']),
            'products_order' => CpsProductMeasureOrder::with('product')->whereOrder($order->id)->get(),
        ]); 
    }

    public function update(ProductOrderSaveRequest $request, Order $order)
    {
        CpsProductMeasureOrder::whereOrder($order->id)->delete();

        if( is_null($request->products) ) {
            return true;
        }

        return $this->save($request, $order);
    }
}
