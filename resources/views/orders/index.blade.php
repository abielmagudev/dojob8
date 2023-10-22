@extends('application')
<x-header>Orders</x-header>
@section('content')
<x-card title="Work Orders">
    <x-slot name="options">
        <x-modal-trigger modal-id="modalCreateOrderClient">
            <b>+</b>
        </x-modal-trigger>
    </x-slot>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>Job</th>
                    <th>Client</th>
                    <th>Zip code</th>
                    <th>Scheduled</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)           
                <tr>
                    <td class="text-nowrap">{{ $order->job->name }}</td>
                    <td class="text-nowrap">
                        <span class="d-block">{{ $order->client->address }}</span>
                        <small>{{ $order->client->fullname }} | {{ $order->client->contact }}</small>
                    </td>
                    <td class="text-nowrap">
                        <span class="d-block">{{ $order->client->zip_code }}</span>
                        <small>{{ $order->client->city }}, {{ $order->client->state }}</small>
                    </td>
                    <td class="text-nowrap">
                        <span class="d-block">{{ $order->scheduled_date_human }}</span>
                        <small>{{ $order->scheduled_time_human }}</small>
                    </td>
                    <td class="text-nowrap text-end">
                        <a href="{{ route('orders.edit', $order) }}" class="btn btn-outline-warning">
                            <i class="bi bi-pencil-fill"></i>
                        </a>
                        <a href="{{ route('orders.show', $order) }}" class="btn btn-outline-primary">
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
<x-pagination-simple :collection="$orders" />
@include('orders.index.modal-create-order-client')
@endsection
