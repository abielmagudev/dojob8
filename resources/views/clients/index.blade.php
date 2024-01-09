@extends('application')

@section('header')
<x-header title="Clients" />
@endsection

@section('content')
<x-card title="">
    <x-slot name="options">
        <x-custom.link-with-total total="{{ $clients->total() }}" route="{{ route('clients.create') }}" />
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
                <x-custom.link-work-orders :parameters="['client' => $client->id]" class="btn btn-warning" unfinished>
                    {{ $client->work_orders_unfinished_count }}
                </x-custom.link-work-orders>
                @endif

                @if( $client->hasWorkOrders() )
                <x-custom.link-work-orders :parameters="['client' => $client->id]">
                    {{ $client->work_orders->count() }}
                </x-custom.link-work-orders>
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
