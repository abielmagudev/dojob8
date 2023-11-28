@extends('application')

@section('header')
<x-header title="Work orders" />
@endsection

@section('content')
<x-card>
    <x-slot name="options">
        <x-modal-trigger modal-id="modalSearchClient">
            <b>+</b>
        </x-modal-trigger>
    </x-slot>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>Crew</th>
                    <th>Job</th>
                    <th>Client</th>
                    <th>Zip Code</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($work_orders as $work_order)           
                <tr>
                    <td class="text-nowrap">
                        @if( $work_order->hasCrew() )
                        <span class="badge {{ $work_order->crew->hasColor() ? '' : 'text-bg-dark' }}" @if( $work_order->crew->hasColor() ) style="background-color:{{ $work_order->crew->color }}" @endif>{{ $work_order->crew->name }}</span>
                        @endif
                    </td>
                    <td class="text-nowrap">{{ $work_order->job->name }}</td>
                    <td class="text-nowrap">
                        <span>{{ $work_order->client->street }}, {{ $work_order->client->location_country_code }}</span>
                        <x-tooltip title="{{ $work_order->client->full_name }}<br>{{ $work_order->client->phone_number }}" html>
                            <a href="#!">
                                <i class="bi bi-info-circle"></i>
                            </a>
                        </x-tooltip>
                    </td>
                    <td class="text-nowrap">{{ $work_order->client->zip_code }}</td>
                    <td class="text-nowrap text-center">
                        <span class="badge w-100 text-bg-primary">{{ $work_order->status }}</span>
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
            </tbody>
        </table>
    </div>
</x-card>
<br>

<x-pagination-simple-eloquent :collection="$work_orders" />
@include('clients.modal-search')
@endsection
