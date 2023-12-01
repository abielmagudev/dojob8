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
            <td>{{ $job->work_orders->count() }}</td>
            <td class="text-nowrap text-end">
                @if( 
                    $work_orders_unsolved = $job->work_orders->filter(function($work_order) use ($statuses_unsolved) {
                        return in_array($work_order->status, $statuses_unsolved);
                    })
                )
                <x-tooltip title="Work orders unsolver">
                <a href="{{ route('work-orders.index', ['job' => $job->id, 'status_group' => $statuses_unsolved, 'status_rule' => 'only') }}" class="btn btn-warning">
                    {{ $work_orders_unsolved->count() }}
                </a>
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
