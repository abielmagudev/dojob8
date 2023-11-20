@extends('application')

@section('header')
<x-header title="Inspection {{ $inspection->id }}" :breadcrumbs="[
    'Back to inspections' => route('inspections.index'),
    'Show' => null
]" />
@endsection

@section('content')
<div class="row">

    {{-- Inspection --}}
    <div class="col-sm">
        <x-card title="Information" class="h-100">        
            <p>
                <small class="d-block text-secondary">Status</small>
                <span class="badge text-uppercase text-bg-{{ $inspection->status_color }}">{{ $inspection->status_label }}</span>
            </p>
        
            <p>
                <small class="d-block text-secondary">Scheduled</small>
                {{ $inspection->scheduled_date->format('D d M, Y') }}
            </p>
        
            <p>
                <small class="d-block text-secondary">Inspector</small>
                {{ $inspection->inspector->name }}
            </p>
        
            <p>
                <small class="d-block text-secondary">Observations</small>
                {{ $inspection->observations }}
            </p>
        
            <p>
                <small class="d-block text-secondary">Notes</small>
                {{ $inspection->notes }}
            </p>
        </x-card>
    </div>

    {{-- Order --}}
    <div class="col-sm">
        <x-card title="Order {{ $inspection->order->id }}" class="h-100">
            <x-slot name="options">
                <a href="{{ route('orders.show', $inspection->order) }}" class="btn btn-primary">
                    <i class="bi bi-eye-fill"></i>
                </a>
            </x-slot>

            <p>
                <small class="d-block text-secondary">Scheduled</small>
                {{ $inspection->order->scheduled_date_human }}
            </p>

            <p>
                <small class="d-block text-secondary">Job</small>
                {{ $inspection->order->job->name }}
            </p>
            
            <p>
                <small class="d-block text-secondary">Client</small>
                {{ $inspection->order->client->fullname }}
                <br>
                {{ $inspection->order->client->address }}
                <br>
                {{ $inspection->order->client->contact_info_collection->filter()->implode(',') }}
            </p>

            <p>
                <small class="d-block text-secondary">Notes</small>
                {{ $inspection->order->notes }}
            </p>
        </x-card>
    </div>

</div>
@endsection
