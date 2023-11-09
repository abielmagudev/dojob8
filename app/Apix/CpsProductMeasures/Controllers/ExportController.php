<?php

namespace App\Apix\CpsProductMeasures\Controllers;

use App\Apix\CpsProductMeasures\Exports\OrderProductMeasuresExport;
use App\Apix\CpsProductMeasures\Models\Category;
use App\Apix\CpsProductMeasures\Models\CpsProductMeasureOrder;
use App\Apix\CpsProductMeasures\Models\Product;
use App\Http\Controllers\Controller;
use App\Models\Extension;
use App\Models\Order;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function index(Extension $extension)
    {
        return view('CpsProductMeasures/views/exports/index', [
            'extension' => $extension,
            'categories' => Category::with('products')->get(),
            'orders' => CpsProductMeasureOrder::with('order')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $query = CpsProductMeasureOrder::with(['product', 'order'])
                    ->whereIn('order_id', function ($query) use ($request) {
                        if(! is_null($request->from) ) {
                            $query->select('id')->from('orders')->where('scheduled_date', '>=', $request->from);
                        }

                        if(! is_null($request->to) ) {
                            $query->select('id')->from('orders')->where('scheduled_date', '<=', $request->to);
                        }
                    })->orderBy('order_id', 'ASC');

        $measures = $request->product ? $query->where('product_id', $request->product)->get() : $query->get();

        return Excel::download(
            new OrderProductMeasuresExport([
                'measures' => $measures,
                'product_name' => is_null($request->product) ? 'All' : (Product::find($request->product)->name),
                'from_at' => is_null($request->from) ? 'Any' : $request->from,
                'to_at' => is_null($request->to) ? 'Any' : $request->to,
            ]), 
            sprintf('cps-product-measurements-%s.xlsx', now())
        );
    }
}
