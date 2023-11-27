@extends('application')

@section('header')
<x-header title="Inspection {{ $inspection->id }}" :breadcrumbs="[
    'Back to inspections' => route('inspections.index'),
    'Inspection' => null
]">
    <x-slot name="options">
        <x-paginate
            :previous="$routes['previous']"
            :next="$routes['next']"
        />
    </x-slot>
</x-header>
@endsection

@section('content')
<div class="row">

    {{-- Inspection --}}
    <div class="col-sm">
        <x-card title="Information" class="h-100">  
            <p>
                <x-badge color="{{ $inspection->approved_color }}" class="text-uppercase">{{ $inspection->approved_status }}</x-badge>
            </p>      
        
            <x-custom.p-label label="Scheduled">
                {{ $inspection->scheduled_date->format('D d M, Y') }}
            </x-custom.p-label>
        
            <x-custom.p-label label="Inspector">
                {{ $inspection->inspector->name }}
            </x-custom.p-label>
        
            <x-custom.p-label label="Observations">
                {{ $inspection->observations }}
            </x-custom.p-label>
        
            <x-custom.p-label label="Notes">
                {{ $inspection->notes }}
            </x-custom.p-label>

            <x-custom.p-label-modifiers :model="$inspection" />
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

            <x-custom.p-label label="Scheduled">
                {{ $inspection->work_order->scheduled_date_human }}
            </x-custom.p-label>

            <x-custom.p-label label="Job">
                {{ $inspection->work_order->job->name }}
            </x-custom.p-label>
            
            <x-custom.p-label label="Client">
                <span class="d-block">{{ $inspection->work_order->client->full_name }}</span>
                <span class="d-block">{{ $inspection->work_order->client->address }}</span>
                <span class="d-block">{{ $inspection->work_order->client->zip_code }}, District {{ $inspection->work_order->client->district }}</span>
                <span class="d-block">{{ $inspection->work_order->client->contact_info_collection->filter()->implode(', ') }}</span>
            </x-custom.p-label>

            <x-custom.p-label label="Notes">
                {{ $inspection->work_order->notes }}
            </x-custom.p-label>
        </x-card>
    </div>

</div>
@endsection
