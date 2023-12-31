@extends('application')

@section('header')
<x-header title="{{ $client->full_name }}" :breadcrumbs="[
    'Back to clients' => route('clients.index'),
    'Client' => null
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
    {{-- Information --}}
    <div class="col-md">
        @include('clients.show.information')
    </div>

    {{-- Summary --}}
    <div class="col-md">
        @include('clients.show.summary')
    </div>
</div>
<br>

@include('clients.show.work-orders')
@endsection
