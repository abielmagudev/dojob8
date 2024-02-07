@extends('application')
@section('header')
    <x-breadcrumb :items="[
        'Agencies' => route('agencies.index'),
        'Agency'
    ]" />
    <x-page-title>{{ $agency->name }}</x-page-title>
@endsection
@section('content')
    <x-card>
        <x-slot name="custom_title">
            <x-custom.indicator-active-status :toggle="$agency->isActive()" />
        </x-slot>
        <x-slot name="options">
            <a href="{{ route('agencies.edit', $agency) }}" class="btn btn-warning btn-sm">
                <i class="bi bi-pencil-fill"></i>
            </a>
        </x-slot>
        <x-small-title title="Notes">
            {{ $agency->notes }}
        </x-small-title>

        <x-custom.information-hook-users :model="$agency" />
    </x-card>
@endsection
