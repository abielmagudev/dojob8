<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientSaveRequest;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        return view('clients.index')->with('clients', Client::withCount('orders')->orderByDesc('id')->paginate(25));
    }

    public function create()
    {
        return view('clients.create')->with('client', new Client);
    }

    public function store(ClientSaveRequest $request)
    {
        if(! $client = Client::create( $request->validated() ) )
            return back()->with('danger', 'Error saving client, please try again');

        return redirect()->route('clients.index')->with('success', "Client <b>{$client->fullname}</b> saved");
    }

    public function show(Client $client)
    {
        return view('clients.show')->with('client', $client->load('orders.job'));
    }

    public function edit(Client $client)
    {
        return view('clients.edit')->with('client', $client);
    }

    public function update(ClientSaveRequest $request, Client $client)
    {
        if(! $client->fill( $request->validated() )->save() )
            return back()->with('danger', 'Error updating client, please try again');

        return redirect()->route('clients.edit', $client)->with('success', "Client <b>{$client->fullname}</b> updated");
    }

    public function destroy(Client $client)
    {
        return $client;
    }
}
