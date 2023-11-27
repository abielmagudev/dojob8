@extends('application')

@section('header')
<x-header title="{{ $intermediary->name }} ({{ $intermediary->alias }})" :breadcrumbs="[
    'Back to intermediaries' => route('intermediaries.index'),
    'Intermediary' => null,
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
<div class="row">
    <div class="col-sm">
        <x-card title="Information">
            <x-slot name="options">
                <a href="{{ route('intermediaries.edit', $intermediary) }}" class="btn btn-warning">
                    <i class="bi bi-pencil-fill"></i>
                </a>
            </x-slot>
            
            <p>
                @if( $intermediary->isAvailable() )
                <span class="badge text-bg-success">Available</span>

                @else
                <span class="badge text-bg-secondary">Unavailable</span>
                
                @endif
            </p>
            
            <x-custom.p-label label="Contact">
                <span class="d-block">{{ $intermediary->contact }}</span>
                @foreach($intermediary->contact_data_collection->filter() as $data)
                <span class="d-block">{{ $data }}</span>
                @endforeach
            </x-custom.p-label>

            <x-custom.p-label label="Address">
                <span class="d-block">{{ $intermediary->street }}</span>
                <span class="d-block">{{ $intermediary->location_country_code }}</span>
                <span class="d-block">{{ $intermediary->zip_code }} <em class="text-secondary">(Zip code)</em></span>
            </x-custom.p-label>

            <x-custom.p-label label="Notes">
                <em>{{ $intermediary->notes }}</em>
            </x-custom.p-label>

            <x-custom.p-label-modifiers :model="$intermediary" />
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
