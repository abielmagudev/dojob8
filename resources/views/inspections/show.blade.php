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

    {{-- Order --}}
    <div class="col-sm">
        <x-card title="Order #{{ $inspection->order->id }}" class="h-100">
            <x-slot name="options">
                <a href="{{ route('orders.show', $inspection->order) }}" class="btn btn-primary">
                    <i class="bi bi-eye-fill"></i>
                </a>
            </x-slot>

            <x-custom.p-label label="Scheduled">
                {{ $inspection->order->scheduled_date_human }}
            </x-custom.p-label>

            <x-custom.p-label label="Job">
                {{ $inspection->order->job->name }}
            </x-custom.p-label>
            
            <x-custom.p-label label="Client">
                <span class="d-block">{{ $inspection->order->client->fullname }}</span>
                <span class="d-block">{{ $inspection->order->client->address }}</span>
                <span class="d-block">{{ $inspection->order->client->contact_info_collection->filter()->implode(',') }}</span>
            </x-custom.p-label>

            <x-custom.p-label label="Notes">
                {{ $inspection->order->notes }}
            </x-custom.p-label>
        </x-card>
    </div>

</div>
@endsection
