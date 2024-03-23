<?php

namespace App\Http\Controllers;

use App\Http\Controllers\WorkOrderController\Index\AuthDataLoader;
use App\Http\Controllers\WorkOrderController\Index\RequestInitializer;
use App\Http\Controllers\WorkOrderController\Show\TabDataLoader;
use App\Http\Requests\WorkOrderStoreRequest;
use App\Http\Requests\WorkOrderUpdateRequest;
use App\Models\Assessment;
use App\Models\Client;
use App\Models\Contractor;
use App\Models\Crew;
use App\Models\Job;
use App\Models\Media\Services\MediaFileDestroyer;
use App\Models\WorkOrder;
use App\Models\WorkOrder\Kernel\WorkOrderStatusCatalog;
use App\Models\WorkOrder\Kernel\WorkOrderTypeCatalog;
use App\Models\WorkOrder\Services\InspectionFactoryService;
use App\Models\WorkOrder\Services\PaymentFactoryService;
use Illuminate\Http\Request;

class WorkOrderController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(WorkOrder::class, 'work_order');
    }

    public function index(Request $request)
    {
        if(! $loader = AuthDataLoader::find( auth()->user() ) ) {
            abort(404);
        }

        $request = RequestInitializer::make($request);

        return view('work-orders.index', $loader->data($request));
    }

    public function create(Request $request)
    {
        if( $request->filled('assessment') )
        {
            $assessment = Assessment::findOrFail($request->assessment);
            $client = $assessment->client;
        }
        else
        {     
            $client = Client::findOrFail($request->client);
        }

        $client->load('work_orders_to_rectify.job');

        return view('work-orders.create', [
            'assessment' => $assessment ?? new Assessment,
            'all_statuses' => WorkOrderStatusCatalog::all(),
            'catalog_types' => new WorkOrderTypeCatalog,
            'client' => $client,
            'contractors' => Contractor::orderBy('name')->get(),
            'crews' => Crew::task('work orders')->active()->orderBy('name', 'desc')->get(),
            'jobs' => Job::orderBy('name')->get(),
            'work_order' => new WorkOrder,
        ]);
    }

    public function store(WorkOrderStoreRequest $request)
    {
        if(! $work_order = WorkOrder::create($request->validated()) ) {
            return back()->with('danger', "Error saving work order, try again please");
        }

        if( $products_array = $request->input('products') )
        {
            $products_to_attach = [];

            foreach($products_array as $product_item)
            {
                $product = json_decode($product_item);

                $products_to_attach[$product->id] = [
                    'quantity' => $product->quantity,
                    'indications' => $product->indications,
                ];
            }

            $work_order->products()->attach($products_to_attach);
        }
        
        if( $work_order->hasCrew() )
        {
            $work_order->members()->attach(
                $work_order->crew->members
            );
        }
        
        InspectionFactoryService::create($work_order);

        PaymentFactoryService::create($work_order);
        
        if( $request->get('after_creating') )
        {
            $parameters = $work_order->assessment_id ? ['assessment' => $work_order->assessment_id] : ['client' => $work_order->client_id];
            $url = route('work-orders.create', $parameters);
        }
        else
        {
            $url = route('work-orders.index');
        }

        return redirect($url)->with('success', "You created the work order <b>#{$work_order->id}: {$work_order->job->name}</b>");
    }

    public function show(Request $request, WorkOrder $work_order)
    {
        if(! $loader = TabDataLoader::get( $request->get('tab') ) ) {
            abort(404);
        }

        return view('work-orders.show', $loader->data($work_order));
    }

    public function edit(Request $request, WorkOrder $work_order)
    {
        $client = $work_order->client;

        $client->load('work_orders_to_rectify.job');

        return view('work-orders.edit', [
            'all_statuses' => WorkOrderStatusCatalog::all(),
            'catalog_types' => new WorkOrderTypeCatalog,
            'client' => $work_order->client->load(['work_orders.job']),
            'contractors' => Contractor::orderBy('name')->get(),
            'crews' => Crew::task('work orders')->active()->orderBy('name', 'desc')->get(),
            'request' => $request,
            'work_order' => $work_order,
            'url_back' => $request->filled('url_back') ? $request->get('url_back') : route('work-orders.show', $work_order),
            'assessment' => new Assessment,
        ]);
    }

    public function update(WorkOrderUpdateRequest $request, WorkOrder $work_order)
    {        
        if(! $work_order->fill( $request->validated() )->save() ) {
            return back()->with('danger', 'Error updating work order, try again please');
        }

        $work_order->refresh();

        if( $products_array = $request->input('products') )
        {
            $products_to_attach = [];

            foreach($products_array as $product_item)
            {
                $product = json_decode($product_item);
                
                $products_to_attach[$product->id] = [
                    'quantity' => $product->quantity,
                    'indications' => $product->indications,
                ];
            }

            $work_order->products()->syncWithoutDetaching($products_to_attach);
        }
        else
        {
            $work_order->products()->detach();
        }

        if( $work_order->hasCrew() )
        {
            $work_order->members()->attach(
                $work_order->crew->members
            );
        }
        else
        {
            $work_order->members()->detach();
        }   

        $parameters = $request->filled('url_back') ? [$work_order, 'url_back' => $request->get('url_back')] : $work_order;

        return redirect()->route('work-orders.edit', $parameters)->with('success', "You updated the work order <b>#{$work_order->id}</b>");
    }

    public function destroy(WorkOrder $work_order)
    {
        $media = $work_order->media;

        if(! $work_order->delete() ) {
            return back()->with('danger', 'Error deleting work order, try again please');
        }        

        foreach($media as $file) {
            MediaFileDestroyer::delete($file);
        }

        $work_order->media()->delete();

        $work_order->history()->delete();

        return redirect()->route('work-orders.index')->with('success', "You deleted the work order <b>#{$work_order->id}</b>");
    }
}
