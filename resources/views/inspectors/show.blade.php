@extends('application')

@section('header')
<x-breadcrumb :items="[
    'Back to Inspectors' => route('inspectors.index'),
    'Inspector'
]" />
<x-page-title>{{ $inspector->name }}</x-page-title>
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
