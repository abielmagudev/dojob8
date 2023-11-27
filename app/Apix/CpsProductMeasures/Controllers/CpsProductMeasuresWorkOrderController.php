<?php

namespace App\Apix\CpsProductMeasures\Controllers;

use App\Apix\CpsProductMeasures\Models\Category;
use App\Apix\CpsProductMeasures\Models\CpsProductMeasureWorkOrder;
use App\Apix\CpsProductMeasures\Models\Product;
use App\Apix\CpsProductMeasures\Requests\ProductWorkOrderSaveRequest;
use App\Http\Controllers\Controller;
use App\Models\Extension;
use App\Models\WorkOrder;
use Illuminate\Http\Request;

class CpsProductMeasuresWorkOrderController extends Controller
{
    private function save(Request $request, WorkOrder $work_order)
    {
        $products_count = count( $request->products );

        $data = [];

        for($i = 0; $i < $products_count; $i++)
        {
            array_push($data, [
                'quantity' => $request->quantities[$i] ?? 0,
                'product_id' => $request->products[$i],
                'work_order_id' => $work_order->id,
                'created_at' => now(),
            ]);
        }

        return CpsProductMeasureWorkOrder::insert($data);
    }

    public function create(Extension $extension)
    {
        return view('CpsProductMeasures/views/work-orders/create', [
            'extension' => $extension,
            'categories' => Category::with('products')->get(),
            'products' => Product::available()->get(['id', 'name']),
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
        return view('CpsProductMeasures/views/work-orders/edit', [
            'extension' => $extension,
            'categories' => Category::with('products')->get(),
            'products' => Product::available()->get(['id', 'name']),
            'work_order_products' => CpsProductMeasureWorkOrder::with('product')
                                                                ->whereWorkOrder($work_order->id)
                                                                ->get(),
        ]); 
    }

    public function update(ProductWorkOrderSaveRequest $request, WorkOrder $work_order)
    {
        CpsProductMeasureWorkOrder::whereWorkOrder($work_order->id)->delete();

        if( is_null($request->products) ) {
            return true;
        }

        return $this->save($request, $work_order);
    }
}
