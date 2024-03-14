@extends('application')

@section('header')
<x-page-title>Jobs</x-page-title>
@endsection

@section('content')
<x-card title="{{ $jobs->total() }}">
    <x-slot name="options">
        <a href="{{ route('jobs.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i>
        </a>
    </x-slot>

    <x-table class="align-middle">
        <x-slot name="thead">
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th class="text-nowrap text-center">Success inspections required</th>
                <th></th>
            </tr>
        </x-slot>
        @foreach($jobs as $job)               
        <tr>
            <td class="{{ $job->isInactive() ? 'text-secondary' : '' }}">{{ $job->name }}</td>
            <td>{{ $job->description }}</td>
            <td class="text-center">{{ $job->success_inspections_required_count }}</td>
            <td class="text-nowrap text-end">
                @includeWhen($job->hasIncompleteWorkOrders(), 'work-orders.__.button-counter-incomplete', [
                        'counter' => $job->incomplete_work_orders_counter,
                        'parameters' => ['job' => $job->id]
                ])

                <a href="{{ route('jobs.show', $job) }}" class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-eye-fill"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </x-table>
</x-card>
<br>

<div class="px-3">
    <x-pagination-simple-model :collection="$jobs" />
</div>
@endsection
