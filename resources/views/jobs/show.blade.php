@extends('application')

@section('header')
<x-breadcrumb :items="[
    'Jobs' => route('jobs.index'),
    'Job'
]" />
<x-page-title>{{ $job->name }}</x-page-title>
@endsection

@section('content')
<div class="row mb-3">
    <div class="col-md mb-3">
        <x-card>
            <x-slot name="title">
                <x-custom.indicator-active-status :toggle="$job->isActive()" />
            </x-slot>

            <x-slot name="options">
                @includeWhen($job->hasWorkOrdersWithIncompleteStatus(), 'work-orders.__.button-counter-incomplete', [
                    'class' => 'btn btn-outline-warning',
                    'counter' => $job->work_orders_with_incomplete_status_counter,
                    'parameters' => ['job' => $job->id],
                ])

                @includeWhen($job->hasWorkOrders(), 'work-orders.__.button-counter-all', [
                    'class' => 'btn btn-outline-primary',
                    'counter' => $job->work_orders_counter,
                    'parameters' => ['job' => $job->id],
                ])
                
                <a href="{{ route('jobs.edit', $job) }}" class="btn btn-warning">
                    <i class="bi bi-pencil-fill"></i>
                </a>
            </x-slot>

            <x-small-title title="Description">
                {{ $job->description }}
            </x-small-title>

            <x-small-title title="Success inspections required">
                {{ $job->success_inspections_required_count }}
            </x-small-title>

            <x-small-title title="Configuration of inspections to create">
                {{ $job->hasInspectionSetup() ? 'Yes' : 'No' }}
            </x-small-title>
            
            <x-custom.information-hook-users :model="$job" />
        </x-card>
    </div>

    <div class="col-md">
    </div>
</div>
@endsection
