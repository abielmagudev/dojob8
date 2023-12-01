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

    <x-table class="align-middle ">
        <x-slot name="thead">
            <tr>
                <th>Contact</th>
                <th>Address</th>
                <th class="text-nowrap">Zip code & District</th>
                <th class="text-nowrap">Work orders</th>
                <th></th>
            </tr>
        </x-slot>

        @foreach($clients as $client)
        <tr>
            <td class="text-nowrap">
                <span class="d-block">{{ $client->full_name }}</span>
                <small>{{ $client->phone_number }}</small>
            </td>
            <td class="text-nowrap">
                <span class="d-block">{{ $client->street }}</span>
                <small>{{ $client->location_country_code }}</small>
            </td>
            <td class="text-nowrap">
                <span class="d-block">{{ $client->zip_code }}</span>
                <small>{{ $client->district_code }}</small>
            </td>
            <td class="text-nowrap">
                <span data-bs-toggle="tooltip" data-bs-title="Total">{{ $client->work_orders_count }}</span>
            </td>
            <td class="text-nowrap text-end">
                @if( $client->hasUnfinishedWorkOrders() )
                <x-tooltip title="Unfinished work orders">
                <a href="{{ $client->getUrlUnfinishedWorkOrders() }}" class="btn btn-warning">{{ $client->work_orders_unfinished_count }}</a>
                </x-tooltip>
                @endif

                <a href="{{ route('clients.show', $client) }}" class="btn btn-outline-primary">
                    <i class="bi bi-eye-fill"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </x-table>
</x-card>
<br>

<x-pagination-simple-eloquent :collection="$clients" />
@endsection
