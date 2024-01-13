<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientSaveRequest;
use App\Models\Client;
use App\Models\WorkOrder;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $clients = Client::with('work_orders')
        ->filterByInputs( $request->all() )
        ->orderByDesc('id')
        ->paginate(25)
        ->appends( $request->query() );

        return view('clients.index', [
            'clients' => $clients,
            'request' => $request,
        ]);
    }

    public function create()
    {
        return view('clients.create')->with('client', new Client);
    }

    public function store(ClientSaveRequest $request)
    {
        if(! $client = Client::create( $request->validated() ) )
            return back()->with('danger', 'Error saving client, please try again');

        $route = $request->has('after_saving') ? route('work-orders.create', $client) : route('clients.index');

        return redirect($route)->with('success', "You created the client <b>{$client->full_name}</b>");
    }

    public function show(Client $client)
    {
        $client->work_orders->load(['crew','contractor','job']);

        return view('clients.show')->with('client', $client);
    }

    public function edit(Client $client)
    {
        return view('clients.edit')->with('client', $client);
    }

    public function update(ClientSaveRequest $request, Client $client)
    {
        if(! $client->fill( $request->validated() )->save() )
            return back()->with('danger', 'Error updating client, please try again');

        return redirect()->route('clients.edit', $client)->with('success', "You updated the client <b>{$client->full_name}</b>");
    }

    public function destroy(Client $client)
    {
        $client->fill(['deleted_by' => mt_rand(1, 10)])->save();

        if(! $client->delete() ) {
            return back()->with('danger', 'Error deleting client, try again please');
        }

        return redirect()->route('clients.index')->with('success', "You deleted the client <b>{$client->full_name}</b>");
    }
}
