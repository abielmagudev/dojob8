@extends('application')

@section('header')
<x-header title="Jobs" />
@endsection

@section('content')
<x-card>
    <x-slot name="options">
        <a href="{{ route('jobs.create') }}" class="btn btn-primary">
            <b>+</b>
        </a>
    </x-slot>
    <x-table class="align-middle">
        <x-slot name="thead">
            <tr>
                <th></th>
                <th>Name</th>
                <th>Extensions</th>
                <th class="text-nowrap">Work orders</th>
                <th></th>
            </tr>
        </x-slot>
        @foreach($jobs as $job)               
        <tr>
            <td style="width:1%">
                <x-tooltip title="{{ ucfirst($job->available_status) }}">
                    <x-circle-off-on :switcher="$job->isAvailable()" />
                </x-tooltip>
            </td>
            <td>{{ $job->name }}</td>
            <td>{{ $job->extensions_count }}</td>
            <td>{{ $job->work_orders_count }}</td>
            <td class="text-nowrap text-end">
                @if( $pending_work_orders = mt_rand(0, $job->work_orders_count) )
                <x-tooltip title="Pending work orders">
                <a href="{{ route('work-orders.index', ['job' => $job->id]) }}" class="btn btn-warning">{{ $pending_work_orders }}</a>
                </x-tooltip>
                @endif

                <a href="{{ route('jobs.show', $job) }}" class="btn btn-outline-primary">
                    <i class="bi bi-eye-fill"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </x-table>
</x-card>
<br>
<x-pagination-simple-eloquent :collection="$jobs" />
@endsection
