@extends('application')

@section('header')
<x-header title="Jobs">
    @slot('subtitle')
    <small class="align-middle badge text-bg-dark">{{ $jobs->total() }}</small>
    @endslot
</x-header>
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
                <th>Description</th>
                <th>Extensions</th>
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
            <td>{{ $job->description }}</td>
            <td>{{ $job->extensions_count }}</td>
            <td class="text-nowrap text-end">
                @if( $job->hasUnfinishedWorkOrders() )
                <x-tooltip title="Unfinished work orders">
                    <a href="{{ $job->url_unfinished_work_orders }}" class="btn btn-warning">
                        {{ $job->work_orders_unfinished->count() }}
                    </a>
                </x-tooltip>
                @endif

                @if( $job->hasWorkOrders() )
                <x-tooltip title="Work orders">
                    <a href="{{ $job->url_own_work_orders }}" class="btn btn-primary">
                        {{ $job->work_orders->count() }}
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
