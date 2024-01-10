@extends('application')

@section('header')
<x-header title="{{ $inspector->name }}" :breadcrumbs="[
    'Back to inspectors' => route('inspectors.index'),
    'Inspector' => null
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
        {{ $inspector->notes }}
    </p>

    <x-custom.content-hook-users :model="$inspector" />
</x-card>
@endsection
