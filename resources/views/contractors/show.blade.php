@extends('application')

@section('header')
<x-header title="{{ $contractor->name }} ({{ $contractor->alias }})" :breadcrumbs="[
    'Back to contractors' => route('contractors.index'),
    'Contractor' => null,
]" />
@endsection

@section('content')
<div class="row">
    <div class="col-sm">
        <x-card title="Information">
            <x-slot name="options">
                <a href="{{ route('contractors.edit', $contractor) }}" class="btn btn-warning">
                    <i class="bi bi-pencil-fill"></i>
                </a>
            </x-slot>
            
            <p>
                <x-badge :color="$contractor->isAvailable() ? 'success' : 'secondary'" class="text-uppercase">{{ $contractor->status }}</x-badge> 
            </p>

            <x-small-label label="Address">
                @include('contractors.__.address', [
                    'except' => ['name_alias']
                ])
            </x-small-label>

            <x-small-label label="Contact">
                @include('contractors.__.contact', [
                    'except' => ['name_alias']
                ])
            </x-small-label>

            <x-small-label label="Notes">
                <em>{{ $contractor->notes }}</em>
            </x-small-label>

            <x-custom.small-label-hook-users :model="$contractor" />
        </x-card>
    </div>

    <div class="col-sm">
        <x-card title="Users" class="h-100">
            <x-slot name="options">
                <a href="#!" class="btn btn-primary px-3">
                    <b>+</b>
                </a>
            </x-slot>
        </x-card>
    </div>
</div>
<br>

<x-card title="Work orders">
            
</x-card>
@endsection
