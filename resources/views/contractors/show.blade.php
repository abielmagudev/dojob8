@extends('application')

@section('header')
<x-breadcrumb :items="[
    'Contractors' => route('contractors.index'),
    'Contractor',
]" />
<x-page-title>{{ $contractor->name }} ({{ $contractor->alias }})</x-page-title>
@endsection

@section('content')
<div class="row">
    <div class="col-sm">
        <x-card>
            @slot('options')
            <a href="{{ route('contractors.edit', $contractor) }}" class="btn btn-warning">
                <i class="bi bi-pencil-fill"></i>
            </a>
            @endslot

            <p>
                <x-indicator-on-off :toggle="$contractor->isAvailable()" />
                <span class="text-capitalize">{{ $contractor->presence_status }}</span>
            </p>

            <address>
                {{ $contractor->street }}<br>
                {{ $contractor->city_name }}<br>
                {{ $contractor->state_name }}, 
                {{ $contractor->country_name }}<br>
                {{ $contractor->zip_code }}<br>
            </address>
    
            <x-custom.content-hook-users :model="$contractor" />
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
