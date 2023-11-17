@extends('application')

@section('header')
<x-header title="{{ $client->fullname }}" :breadcrumbs="[
    'Back to clients' => route('clients.index'),
    'Client' => null
]" />
@endsection

@section('content')
<div class="row">
    <div class="col-sm">
        <x-card>
            <x-slot name="options">
                <a href="{{ route('clients.edit', $client) }}" class="btn btn-warning">
                    <i class="bi bi-pencil-fill"></i>
                </a>
            </x-slot>
            <p>
                <small class="text-secondary">Address</small>
                <span class="d-block">{{ $client->street }}</span>
                <span class="d-block">{{ $client->location_country_code }}</span>
                <span class="d-block">{{ $client->zip_code }}</span>
            </p>
    
            <p>
                <small class="text-secondary">Contact</small>
                @foreach($client->contact_info_collection->filter() as $value)
                <span class="d-block">{{ $value }}</span>
                @endforeach
            </p>
    
            <p>
                <small class="d-block text-secondary">Notes</small>
                <span>{{ $client->notes }}</span>
            </p>
        </x-card>
    </div>

    <div class="col-sm col-md-9">
        <x-card title="Orders">
            <x-slot name="options">
                <a href="{{ route('orders.create', $client) }}" class="btn btn-primary px-3">
                    <b>+</b>
                </a>
            </x-slot>
        
            @if( $client->orders->count() )          
            <x-table class="align-middle ">
                @foreach($client->orders as $order)
                <tr>
                    <td>{{ $order->job->name }}</td>
                    <td>{{ $order->scheduled_datetime_human }}</td>
                    <td class="text-end">
                        <a href="{{ route('orders.show', $order) }}" class="btn btn-outline-primary">
                            <i class="bi bi-eye-fill"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </x-table>
            @endif
        </x-card>
    </div>
</div>
<br>

@endsection
