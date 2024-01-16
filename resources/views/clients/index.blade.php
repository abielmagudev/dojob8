@extends('application')

@section('header')
<x-page-title>Clients</x-page-title>
@endsection

@section('content')
<x-card>
    <x-slot name="options">
        <a href="{{ route('clients.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i>
        </a>
    </x-slot>

    @if( $request->filled('search') )
    <p>
        <b>{{ $clients->total() }}</b>
        <span class="text-secondary me-1">found searching for</span>
        <em>{{ $request->get('search') }}</em>
    </p>
    @endif

    @if( $clients->count() )
    <x-table>
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
                {!! $request->filled('search') ? marker($request->get('search'), $client->full_name) : $client->full_name !!}
            </td>
            <td class="text-nowrap">
                @include('clients.__.address-table-cell', ['mark' => $request->get('search')])
            </td>
            <td class="text-nowrap">
                @include('clients.__.contact-table-cell', ['mark' => $request->get('search')])
            </td>
            <td class="text-nowrap text-end">

                @includeWhen($client->hasUnfinishedWorkOrders(), 'work-orders.__.button-counter-unfinished', [
                    'counter' => $client->work_orders_unfinished_count,
                    'parameters' => ['client' => $client->id],
                ])

                <a href="{{ route('work-orders.create', $client) }}" class="btn btn-outline-success btn-sm">
                    <i class="bi bi-plus-lg"></i>
                </a>

                <a href="{{ route('clients.show', $client) }}" class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-eye-fill"></i>
                </a>
                
            </td>
        </tr>
        @endforeach
    </x-table>
    @endif
</x-card>
<br>

<div class="px-3">
    <x-pagination-simple-model :collection="$clients" />
</div>
<br>
@endsection
