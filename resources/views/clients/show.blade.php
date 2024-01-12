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
    <div class="col-md col-md-6 col-lg-4">
        @include('clients.show.information')
    </div>

    {{-- Work orders --}}
    <div class="col-md col-md-6 col-lg-8">
        @include('clients.show.work-orders')
    </div>
</div>
<br>

@endsection
