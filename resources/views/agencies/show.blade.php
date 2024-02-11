@extends('application')
@section('header')
<x-breadcrumb :items="[
    'Agencies' => route('agencies.index'),
    'Agency'
]" />
<x-page-title>{{ $agency->name }}</x-page-title>
@endsection

@section('content')
    <x-card>
        <x-slot name="title">
            <x-custom.indicator-active-status :toggle="$agency->isActive()" />
        </x-slot>

        <x-slot name="options">
            @includeWhen($agency->hasInspectionsWithPendingStatus(), 'inspections.__.button-counter-pending', [
                'class' => 'btn btn-outline-warning btn-sm',
                'counter' => $agency->inspections_with_pending_status_counter,
                'parameters' => ['agency' => $agency->id],
            ])

            @includeWhen($agency->hasInspectionsWithAwaitingStatus(), 'inspections.__.button-counter-awaiting', [
                'class' => 'btn btn-outline-primary btn-sm',
                'counter' => $agency->inspections_with_awaiting_status_counter,
                'parameters' => ['agency' => $agency->id],
            ])

            <a href="{{ route('agencies.edit', $agency) }}" class="btn btn-warning btn-sm">
                <i class="bi bi-pencil-fill"></i>
            </a>
        </x-slot>
        <x-small-title title="Notes">
            {{ $agency->notes }}
        </x-small-title>

        <x-custom.information-hook-users :model="$agency" />
    </x-card>
@endsection
