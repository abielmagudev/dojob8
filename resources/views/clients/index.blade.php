@extends('application')

@section('header')
<x-page-title>Clients</x-page-title>
@endsection

@section('content')
<x-card title="{{ $clients->total() }}" subtitle="{{ $request->has('search') ? sprintf('Searching: %s', $request->get('search')) : '' }}">
    <x-slot name="options">
        <a href="{{ route('clients.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i>
        </a>
    </x-slot>

    @if( $clients->count() )
    <x-table>
        <x-slot name="thead">
            <tr>
                <th class="text-nowrap">Full name</th>
                <th>Address</th>
                <th class="text-nowrap">Zip code</th>
                {{-- <th class="text-nowrap">District code</th> --}}
                <th>Contact</th>
                <th></th>
            </tr>
        </x-slot>

        @foreach($clients as $client)
        <tr>

            <td class="text-nowrap">
                {!! marker($request->get('search', ''), $client->full_name) !!}
            </td>

            <td class="text-nowrap">
                {!! marker($request->get('search', ''), $client->street) !!},
                {!! marker($request->get('search', ''), $client->city_name) !!},
                {!! marker($request->get('search', ''), $client->state_name) !!}
                {{-- {!! marker($request->get('search', ''), $client->country_name) !!} --}}
                @include('clients.__.link-google-maps')
            </td>

            <td class="text-nowrap text-center">
                {!! marker($request->get('search', ''), $client->zip_code) !!}
            </td>

            {{-- 
            <td class="text-nowrap text-center">
                {!! marker($request->get('search', ''), $client->district_code ?? '') !!}
            </td>  
            --}}

            <td class="text-nowrap">
                <div class="d-flex flex-column flex-md-row flex-wrap">
                    @foreach($client->contact_data->filter() as $key => $value)
                    <?php $prefix = $key <> 'email' ? 'tel' : 'mailto' ?>
                    <x-tooltip title="{{ ucfirst($key) }}">
                        <span class="d-inline-block small mx-2">
                            <a href="{{ $prefix }}:{{ $value }}" class="text-decoration-none">
                                {!! marker($request->get('search', ''), $value) !!}
                            </a>
                        </span>
                    </x-tooltip>
                    @endforeach
                </div>
            </td>
            
            <td class="text-nowrap text-end">

                @includeWhen($client->hasIncompleteWorkOrders(), 'work-orders.__.button-counter-incomplete', [
                    'counter' => $client->incomplete_work_orders_counter,
                    'parameters' => ['client' => $client->id],
                ])

                <a href="{{ route('work-orders.create', ['client' => $client->id]) }}" class="btn btn-outline-success btn-sm">
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
