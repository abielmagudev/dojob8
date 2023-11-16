@extends('application')

@section('header')
<x-header title="{{ $intermediary->name }} ({{ $intermediary->alias }})" :breadcrumbs="[
    'Back to intermediaries' => route('intermediaries.index'),
    'Intermediary' => null,
]" />
@endsection

@section('content')
<div class="row">
    <div class="col-sm">
        <x-card title="Information">
            <x-slot name="options">
                <a href="{{ route('intermediaries.edit', $intermediary) }}" class="btn btn-warning">
                    <i class="bi bi-pencil-fill"></i>
                </a>
            </x-slot>
        
            <div class="row">
                <div class="col-sm">
                    <p>
                        <small class="text-secondary">Contact</small>
                        <br>
                        <span>{{ $intermediary->contact }}</span>
                    </p>
                    <p>
                        <small class="text-secondary">Email</small>
                        <br>
                        <span>{{ $intermediary->email }}</span>
                    </p>
                    <p>
                        <small class="text-secondary">Phone</small>
                        <br>
                        <span>{{ $intermediary->phone_number }}</span>
                    </p>
                    <p>
                        <small class="text-secondary">Mobile</small>
                        <br>
                        <span>{{ $intermediary->mobile_number }}</span>
                    </p>
                    <p>
                        <small class="text-secondary">Address</small>
                        <br>
                        {!! implode('<br>', $intermediary->address_array) !!}
                    </p>
                </div>
                <div class="col-sm">
                    <p>
                        <small class="text-secondary">Notes</small>
                        <br>
                        <em>{{ $intermediary->notes }}</em>
                    </p>
                </div>
            </div>
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

<x-card title="Orders">
            
</x-card>
@endsection
