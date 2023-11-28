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
<x-card title="Information">
    <x-slot name="options">
        <a href="{{ route('clients.edit', $client) }}" class="btn btn-warning">
            <i class="bi bi-pencil-fill"></i>
        </a>
    </x-slot>

    <x-small-label label="Contact">
        @foreach($client->contact_data_collection->filter() as $value)
        <span class="d-block">{{ $value }}</span>
        @endforeach
    </x-small-label>
    
    <x-small-label label="Address">
        <span class="d-block">{{ $client->street }}</span>
        <span class="d-block">{{ $client->location_country_code }}</span>
        <span class="d-block">{{ $client->zip_code }} <em class="text-secondary">(Zip code)</em></span>
        <span>{{ $client->district_code }} <em class="text-secondary">(District)</em></span>
    </x-small-label>

    <x-small-label label="Notes">
        <span>{{ $client->notes }}</span>
    </x-small-label>

    <x-custom.small-label-hook-users :model="$client" />
</x-card>
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
