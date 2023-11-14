@extends('application')

@section('header')
<x-header title="Clients" />
@endsection

@section('content')
<x-card title="">
    <x-slot name="options">
        <a href="{{ route('clients.create') }}" class="btn btn-primary">
            <b>+</b>
        </a>
    </x-slot>

    <x-table>
        <x-slot name="thead">
            <tr>
                <th>Fullname</th>
                <th>Address</th>
                <th>Zip code</th>
                <th>Orders</th>
                <th></th>
            </tr>
        </x-slot>

        @foreach($clients as $client)
        <tr>
            <td class="text-nowrap">{{ $client->fullname }}</td>
            <td class="text-nowrap">
                <p class="m-0">{{ $client->address }}</p>
                <small class="text-secondary">{{ $client->location }}</small>
            </td>
            <td class="text-nowrap">{{ $client->zip_code }}</td>
            <td>{{ $client->orders_count }}</td>
            <td class="text-nowrap text-end">
                <a href="{{ route('orders.create', $client) }}" class="btn btn-outline-success px-3">
                    <b>+</b>
                </a>
                <a href="{{ route('clients.show', $client) }}" class="btn btn-outline-primary">
                    <i class="bi bi-eye-fill"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </x-table>
</x-card>
<br>
<x-pagination-simple :collection="$clients" />
@endsection
