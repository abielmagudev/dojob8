@extends('application')

@section('header')
<x-breadcrumb :items="[
    'Crews' => route('crews.index'),
    'Crew',
]" />
<x-page-title>{{ $crew->name }}</x-page-title>
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

@endsection
