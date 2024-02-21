<?php

namespace App\Xapis\Stock\WeatherizationCps\Controllers;

use App\Xapis\Stock\WeatherizationCps\Exports\WeatherizationCpsWorkOrderExport;
use App\Xapis\Stock\WeatherizationCps\Models\Category;
use App\Xapis\Stock\WeatherizationCps\Models\WeatherizationCpsWorkOrder;
use App\Xapis\Stock\WeatherizationCps\Models\Product;
use App\Http\Controllers\Controller;
use App\Models\Extension;
use App\Models\WorkOrder;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function index(Extension $extension)
    {
        return view('WeatherizationCps/views/exports/index', [
            'extension' => $extension,
            'categories' => Category::with('products')->get(),
            'work_orders' => WeatherizationCpsWorkOrder::with('work_order')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $work_orders_table = (new WorkOrder)->getTable();

        $query = WeatherizationCpsWorkOrder::with(['product', 'work_order']);
        
        if(! is_null($request->from) ||! is_null($request->to) )
        {
            $query->whereIn('work_order_id', function ($query) use ($request, $work_orders_table) {

                if(! is_null($request->from) ) {
                    $query->select('id')->from($work_orders_table)->where('scheduled_date', '>=', $request->from);
                }

                if(! is_null($request->to) ) {
                    $query->select('id')->from($work_orders_table)->where('scheduled_date', '<=', $request->to);
                }

                return $query;
                
            })->orderBy('work_order_id');
        }

        $measures = $request->product ? $query->where('product_id', $request->product)->get() : $query->get();

        return Excel::download(
            new WeatherizationCpsWorkOrderExport([
                'measures' => $measures,
                'product_name' => is_null($request->product) ? 'All' : (Product::find($request->product)->name),
                'from_at' => is_null($request->from) ? 'Any' : $request->from,
                'to_at' => is_null($request->to) ? 'Any' : $request->to,
            ]), 
            sprintf('weatherization-products-cps-%s.xlsx', now())
        );
    }
}
