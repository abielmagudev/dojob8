@extends('application')

@section('header')
<x-header title="{{ $inspector->name }}" :breadcrumbs="[
    'Back to inspectors' => route('inspectors.index'),
    'Inspector' => null
]">
    <x-slot name="options">
        <x-custom.pagination-simple-routes
            :previous="$routes['previous']"
            :next="$routes['next']"
        />
    </x-slot>
</x-header>
@endsection

@section('content')
<x-card title="Information">
    <x-slot name="options">
        <a href="{{ route('inspectors.edit', $inspector) }}" class="btn btn-warning">
            <i class="bi bi-pencil-fill"></i>
        </a>
    </x-slot>

    <x-custom.p-label label="Notes">
        {{ $inspector->notes }}
    </x-custom.p-label>

    <x-custom.p-label-modifiers :model="$inspector" />
</x-card>
@endsection
