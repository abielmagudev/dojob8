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
                <th class="text-nowrap">Full name</th>
                <th>Address</th>
                <th>Zip</th>
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
                <small>D-{{ $client->district_code }}</small>
            </td>
            <td class="text-nowrap">
                @if( $client->work_orders_count )
                <span class="badge rounded text-bg-dark" data-bs-toggle="tooltip" data-bs-title="Total">{{ $client->work_orders_count }}</span>
                
                @if(mt_rand(0,1))
                <span class="badge rounded text-bg-danger" data-bs-toggle="tooltip" data-bs-title="Pending">{{ mt_rand(1, $client->work_orders_count) }}</span>
                @endif

                @endif
            </td>
            <td class="text-nowrap text-end">
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
