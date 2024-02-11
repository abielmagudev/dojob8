@extends('application')

@section('header')

<x-breadcrumb :items="[
    'Inspections' => route('inspections.index'),
    'Inspection',
]" />

<x-page-title>
    <span>Inspection #{{ $inspection->id }}</span>

    @slot('subtitle')
    <a href="{{ route('work-orders.show', [$inspection->work_order, 'tab' => 'inspections']) }}">
        Work order #{{ $inspection->work_order->id }} - {{ $inspection->work_order->job->name }}
    </a>
    @endslot
</x-page-title>

@endsection

@section('content')
<x-card>  
    @slot('title')
    @include('inspections.__.status-flag', [
        'status' => $inspection->status,
    ])
    @endslot

    @slot('options')
    <a href="{{ route('inspections.edit', $inspection) }}" class="btn btn-warning">
        <i class="bi bi-pencil-fill"></i>
    </a>
    @endslot  

    <x-small-title title="Scheduled">
        {{ $inspection->scheduled_date_human }}
    </x-small-title>

    <x-small-title title="Inspector">
        {{ $inspection->inspector->name }}
    </x-small-title>

    <x-small-title title="Crew">
        {{ $inspection->hasCrew() ? $inspection->crew->name : '' }}
    </x-small-title>

    <x-small-title title="Observations">
        {{ $inspection->observations }}
    </x-small-title>

    <x-custom.information-hook-users :model="$inspection" />
</x-card>
@endsection
