@extends('application')

@section('header')
<x-header title="Work orders" />
@endsection

@section('content')
<x-card>
    <x-slot name="options">
        <div class="btn-group">
            <button class="btn btn-primary d-none" data-bs-toggle="tooltip" data-bs-title="View">
                <i class="bi bi-columns"></i>
            </button>
            <button class="btn btn-primary d-none" data-bs-toggle="tooltip" data-bs-title="Filter">
                <i class="bi bi-filter"></i>
            </button>
            <x-modal-trigger modal-id="modalSearchClient">
                <b>+</b>
            </x-modal-trigger>
        </div>
    </x-slot>

    @if( $work_orders->count() ) 
    <x-table class="align-middle">
        <x-slot name="thead">
        <tr>
            <th>Priority</th>
            <th>Estimated</th>
            <th>Crew</th>
            <th>Job</th>
            <th>Client</th>
            <th>Contractor</th>
            <th>Status</th>
            <th></th>
        </tr>
        </x-slot>

        @foreach($work_orders as $work_order)           
        <tr>
            <td>
                <input type="number" class="form-control form-control-sm" min="1" step="1" style="width:56px">
            </td>
            <td class="text-nowrap">{{ $work_order->scheduled_time_human }}</td>
            <td class="text-nowrap">
                @if( $work_order->hasCrew() )
                <span class="badge w-100 {{ $work_order->crew->hasColor() ? '' : 'text-bg-dark' }}" @if( $work_order->crew->hasColor() ) style="background-color:{{ $work_order->crew->color }}" @endif>{{ $work_order->crew->name }}</span>
                @endif
            </td>
            <td class="text-nowrap">{{ $work_order->job->name }}</td>
            <td class="text-nowrap">
                <span>
                    {{ $work_order->client->street }}, 
                    {{ $work_order->client->location_country_code }}, 
                </span>
                <b>{{ $work_order->client->zip_code }}</b>
                <x-tooltip :title="$work_order->client->full_name . '<br>' . $work_order->client->contact_data_collection->filter()->except('email')->implode('<br>')" html>
                    <a href="#!">
                        <i class="bi bi-info-circle"></i>
                    </a>
                </x-tooltip>
            </td>
            <td class="text-nowrap text-center">
                @if( $work_order->hasIntermediary() )
                <x-tooltip :title="$work_order->intermediary->name">
                    <span>{{ $work_order->intermediary->alias }}</span>
                </x-tooltip>
                @endif
            </td>
            <td class="text-nowrap text-center text-uppercase">
                <span class="badge w-100 {{ $work_order->status_color }}">{{ $work_order->status_text }}</span>
            </td>
            <td class="text-nowrap text-end">

                <a href="{{ route('work-orders.edit', $work_order) }}" class="btn btn-outline-warning">
                    <i class="bi bi-pencil-fill"></i>
                </a>

                <a href="{{ route('work-orders.show', $work_order) }}" class="btn btn-outline-primary">
                    <i class="bi bi-eye-fill"></i>
                </a>
                
            </td>
        </tr>
        @endforeach

    </x-table>
    @endif

</x-card>
<br>

<x-pagination-simple-eloquent :collection="$work_orders" />
@include('clients.modal-search')
@endsection
