@extends('application')

@section('header')
<x-header title="Inspector {{ $inspector->name }}" :breadcrumbs="[
    'Back to inspectors' => route('inspectors.index'),
    $inspector->id => null
]" />
@endsection

@section('content')
<x-card title="Information">
    <x-slot name="options">
        <a href="{{ route('inspectors.edit', $inspector) }}" class="btn btn-warning">
            <i class="bi bi-pencil-fill"></i>
        </a>
    </x-slot>

    <p>
        <small class="d-block text-secondary">Notes</small>
        {{ $inspector->notes }}
    </p>
</x-card>
@endsection
