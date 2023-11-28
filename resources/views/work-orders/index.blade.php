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
                    <td class="text-nowrap">{{ $work_order->job->name }}</td>
                    <td class="text-nowrap">
                        <span>{{ $work_order->client->street }}, {{ $work_order->client->location_country_code }}</span>
                        <a href="#!" data-bs-toggle="tooltip" data-bs-html="true" data-bs-title="{{ $work_order->client->full_name }}<br>{{ $work_order->client->phone_number }}">
                            <i class="bi bi-info-circle"></i>
                        </a>
                    </td>
                    <td class="text-nowrap">{{ $work_order->client->zip_code }}</td>
                    <td class="text-nowrap text-center">
                        @if( mt_rand(0, 1) )
                        <span class="badge w-100 text-bg-primary">New</span>
                        
                        @elseif( mt_rand(0,1) )
                        <span class="badge w-100 text-bg-warning">Working</span>
                        
                        @elseif( mt_rand(0,1) )
                        <span class="badge w-100 text-bg-success">Done</span>
                        
                        @elseif( mt_rand(0,1) )
                        <span class="badge w-100 text-bg-secondary">Canceled</span>
                        
                        @else
                        <span class="badge w-100 text-bg-dark">Closed</span>

                        @endif
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
