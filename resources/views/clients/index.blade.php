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

    <x-table class="align-middle">
        <x-slot name="thead">
            <tr>
                <th>Address</th>
                <th>Name</th>
                <th>Contact</th>
                <th></th>
            </tr>
        </x-slot>

        @foreach($clients as $client)
        <tr>
            <td class="text-nowrap">
                @include('clients.__.address-table-cell', [
                    'except' => ['full_name']
                    ])
            </td>
            <td class="text-nowrap">
                {{ $client->full_name }}
            </td>
            <td>
                @include('clients.__.contact-table-cell', [
                    'except' => ['full_name']
                ])
            </td>
            <td class="text-nowrap text-end">
                @if( $client->hasUnfinishedWorkOrders() )
                <x-tooltip title="Unfinished work orders">
                    <a href="{{ $client->getUrlUnfinishedWorkOrders() }}" class="btn btn-warning">{{ $client->work_orders_unfinished_count }}</a>
                </x-tooltip>
                @endif

                @if( $client->hasWorkOrders() )
                <x-tooltip title="Work orders">
                    <a href="{{ $client->getUrlWorkOrdersFilteredBySelf() }}" class="btn btn-primary">{{ $client->work_orders->count() }}</a>
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
