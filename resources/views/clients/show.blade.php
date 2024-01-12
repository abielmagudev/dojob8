@extends('application')

@section('header')
<x-breadcrumb :items="[
    'Clients' => route('clients.index'),
    'Client'
]" />
<x-page-title>{{ $client->full_name  }}</x-page-title>
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
