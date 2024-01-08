@extends('application')

@section('header')
<x-header title="Inspection {{ $inspection->id }}" :breadcrumbs="[
    'Back to inspections' => route('inspections.index'),
    'Inspection' => null
]" />
@endsection

@section('content')
<div class="row">

    {{-- Inspection --}}
    <div class="col-sm">
        <x-card title="Information" class="h-100">  
            @slot('options')
            <a href="{{ route('inspections.edit', $inspection) }}" class="btn btn-warning">
                <i class="bi bi-pencil-fill"></i>
            </a>
            @endslot
            
            <p>
                @include('inspections.__.status_color', ['status' => $inspection->status])
            </p>      
        
            <x-small-label label="Scheduled">
                {{ $inspection->scheduled_date_human }}
            </x-small-label>
        
            <x-small-label label="Inspector">
                {{ $inspection->inspector->name }}
            </x-small-label>

            <x-small-label label="Crew">
                {{ $inspection->hasCrew() ? $inspection->crew->name : '' }}
            </x-small-label>
        
            <x-small-label label="Observations">
                {{ $inspection->observations }}
            </x-small-label>

            <x-custom.small-label-hook-users :model="$inspection" />
        </x-card>
    </div>

    {{-- Work order --}}
    <div class="col-sm">
        <x-card title="Work order #{{ $inspection->work_order->id }}" class="h-100">
            <x-slot name="options">
                <a href="{{ route('work-orders.show', $inspection->work_order) }}" class="btn btn-primary">
                    <i class="bi bi-eye-fill"></i>
                </a>
            </x-slot>

            <x-small-label label="Scheduled">
                {{ $inspection->work_order->scheduled_date_human }}
            </x-small-label>

            <x-small-label label="Job">
                {{ $inspection->work_order->job->name }}
            </x-small-label>
            
            <x-small-label label="Client">
                @include('clients.__.address', ['client' => $inspection->work_order->client])
            </x-small-label>

            <x-small-label label="Notes">
                {{ $inspection->work_order->notes }}
            </x-small-label>
        </x-card>
    </div>

</div>
@endsection
