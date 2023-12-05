@extends('application')

@section('header')
<x-header title="{{ $client->full_name }}" :breadcrumbs="[
    'Back to clients' => route('clients.index'),
    'Client' => null
]">
    <x-slot name="options">
        <x-paginate
            :previous="$routes['previous']" 
            :next="$routes['next']" 
        />
    </x-slot>
</x-header>
@endsection

@section('content')
<div class="row">
    {{-- Information --}}
    <div class="col-md">
        <x-card title="Information">
            <x-slot name="options">
                <a href="{{ route('clients.edit', $client) }}" class="btn btn-warning">
                    <i class="bi bi-pencil-fill"></i>
                </a>
            </x-slot>
            
            <x-small-label label="Address">
                <address>
                    <span class="d-block">{{ $client->street }}</span>
                    <span class="d-block">{{ $client->location_state_code->implode(', ') }} {{ $client->zip_code }}</span>
                    <span class="d-block">{{ $client->country_name }}</span>
                    <span class="d-block">District {{ $client->district_code }}</span>
                    <small>
                        <a href="{{ $client->url_search_address_google_maps }}" target="_blank">Google Maps</a>
                    </small>
                </address>
            </x-small-label>
        
            <x-small-label label="Contact">
                @foreach($client->contact_data_collection->filter() as $key => $value)
                <div class="mb-1">
                    <span class="badge text-bg-light fw-normal " style="font-size:1rem">
                        <span class="me-1">{{ ucfirst($key) }}</span>
                        <?php $prefix = $key <> 'email' ? 'tel' : 'mailto' ?>
                        <a href="{{ $prefix }}:{{ $value }}">{{ $value }}</a>
                    </span>
                </div>
                @endforeach
            </x-small-label>

            <x-small-label label="Notes">
                <span>{{ $client->notes }}</span>
            </x-small-label>
        
            <x-custom.small-label-hook-users :model="$client" />
        </x-card>
    </div>

    {{-- Summary --}}
    <div class="col-md">
        <x-card title="Sumary"></x-card>
    </div>
</div>
<br>

<x-card title="Work orders" class="h-100">
    <x-slot name="options">
        <a href="{{ route('work-orders.create', $client) }}" class="btn btn-primary">
            <b>+</b>
        </a>
    </x-slot>

    @if( $client->work_orders->count() )          
    <x-table class="align-middle ">
        @foreach($client->work_orders as $work_order)
        <tr>
            <td>{{ $work_order->job->name }}</td>
            <td>{{ $work_order->scheduled_datetime_human }}</td>
            <td class="text-end">
                <a href="{{ route('work-orders.show', $work_order) }}" class="btn btn-outline-primary">
                    <i class="bi bi-eye-fill"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </x-table>
    @endif
</x-card>
@endsection
