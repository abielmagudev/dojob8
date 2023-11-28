@extends('application')

@section('header')
<x-header title="{{ $crew->name }}" :breadcrumbs="[
    'Back to crews' => route('crews.index'),
    'Crew' => null,
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

    <div class="col-md col-md-4 mb-3 mb-md-0">
       @include('crews.show.information')
    </div>

    <div class="col-md col-md-8">
        @include('crews.show.members')
    </div>
</div>

@include('crews.show.modal-crew-member-update')
@endsection
