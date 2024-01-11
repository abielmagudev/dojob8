@extends('application')

@section('header')
<x-page-title >Clients</x-page-title>
@endsection

@section('content')
<x-card title="">
    <x-slot name="options">
        {{ $clients->total() }}
        <a href="{{ route('clients.create') }}" class="btn btn-primary">
            <b>+</b>
        </a>
    </x-slot>

    <x-table class="align-middle">
        <x-slot name="thead">
            <tr>
                <th>Full name</th>
                <th>Address</th>
                <th>Contact</th>
                <th></th>
            </tr>
        </x-slot>

        @foreach($clients as $client)
        <tr>
            <td class="text-nowrap">
                {{ $client->full_name }}
            </td>
            <td class="text-nowrap">
                @include('clients.__.address-table-cell')
            </td>
            <td>
                @include('clients.__.contact-table-cell')
            </td>
            <td class="text-nowrap text-end">

                @if( $client->hasUnfinishedWorkOrders() )
                <a href="{{ \App\Models\WorkOrder\WorkOrderUrlGenerator::unfinished(['client' => $client->id]) }}" class="btn btn-warning">
                    {{ $client->work_orders_unfinished_count }}
                </a>
                @endif

                @if( $client->hasWorkOrders() )
                <a href="{{ \App\Models\WorkOrder\WorkOrderUrlGenerator::all(['client' => $client->id]) }}" class="btn btn-primary">
                    {{ $client->work_orders->count() }}
                </a>
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

<x-pagination-simple-model :collection="$clients" />
@endsection
