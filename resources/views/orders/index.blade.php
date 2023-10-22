@extends('application')
<x-header>Orders</x-header>
@section('content')
<x-card title="Work Orders">
    <x-slot name="options">
        <a href="{{ route('orders.create') }}" class="btn btn-primary">
            <b>+</b>
        </a>
    </x-slot>
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>Job</th>
                    <th colspan="2">Scheduled</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)           
                <tr>
                    <td class="text-nowrap">{{ $order->job->name }}</td>
                    <td class="text-nowrap" style="width:0%">{{ $order->scheduled_date_human }}</td>
                    <td class="text-nowrap" style="width:0%">{{ $order->scheduled_time_human }}</td>
                    <td class="text-end">
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
@endsection
