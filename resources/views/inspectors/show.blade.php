@extends('application')

@section('header')
<x-header title="{{ $inspector->name }}" :breadcrumbs="[
    'Back to inspectors' => route('inspectors.index'),
    'Inspector' => null
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
<x-card title="Information">
    <x-slot name="options">
        <a href="{{ route('inspectors.edit', $inspector) }}" class="btn btn-warning">
            <i class="bi bi-pencil-fill"></i>
        </a>
    </x-slot>

    <x-small-label label="Notes">
        {{ $inspector->notes }}
    </x-small-label>

    <x-custom.small-label-hook-users :model="$inspector" />
</x-card>
@endsection
