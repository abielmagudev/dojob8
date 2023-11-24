@extends('application')

@section('header')
<x-header title="{{ $crew->name }}" :breadcrumbs="[
    'Back to crews' => route('crews.index'),
    'Crew' => null,
]" />
@endsection

@section('content')
<div class="row">
    <div class="col-md col-md-4">
        <x-card title="Information">
            <x-slot name="options">
                <a href="{{ route('crews.edit', $crew) }}" class="btn btn-warning">
                    <i class="bi bi-pencil-fill"></i>
                </a>
            </x-slot>
        
            <p>
                <x-badge :color="$crew->isActive() ? 'success' : 'secondary'" class="text-uppercase">{{ $crew->active_status }}</x-badge>
                <span class="align-middle" style="color: {{ $crew->color }}">
                    <i class="bi bi-circle-fill"></i>
                </span>
            </p>
        
            <x-custom.p-label label="Name">
                {{ $crew->name }}
            </x-custom.p-label>
        
            <x-custom.p-label label="Description">
                {{ $crew->description }}
            </x-custom.p-label>
        
            <x-custom.p-label-modifiers :model="$crew" />
        </x-card>
    </div>
    <div class="col-md col-md-8">
        <x-card title="Members">
            <x-slot name="options">
                <button class="btn btn-primary" type="button">
                    <b>+</b>
                </button>
            </x-slot>

        </x-card>
    </div>
</div>
@endsection
