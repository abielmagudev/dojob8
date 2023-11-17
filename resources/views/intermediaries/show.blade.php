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
        
            <p>
                <small class="text-secondary d-block">Status</small>
                @if( $intermediary->isAvailable() )
                <span class="badge text-bg-success">Available</span>

                @else
                <span class="badge text-bg-secondary">Unavailable</span>
                
                @endif
            </p>

            <p>
                <small class="text-secondary">Contact</small>
                <span class="d-block">{{ $intermediary->contact }}</span>
                <span class="d-block">{{ $intermediary->phone_number }}</span>
                <span class="d-block">{{ $intermediary->mobile_number }}</span>
                <span class="d-block">{{ $intermediary->email }}</span>
            </p>
            <p>
                <small class="text-secondary">Address</small>
                <span class="d-block">{{ $intermediary->street }}</span>
                <span class="d-block">{{ $intermediary->location_country_code }}</span>
                <span class="d-block">{{ $intermediary->zip_code }}</span>
            </p>
            <p>
                <small class="text-secondary">Notes</small>
                <em class="d-block ">{{ $intermediary->notes }}</em>
            </p>
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
