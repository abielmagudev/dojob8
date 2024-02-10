@extends('application')

@section('header')
<x-breadcrumb :items="[
    'Jobs' => route('jobs.index'),
    'Job'
]" />
<x-page-title>{{ $job->name }}</x-page-title>
@endsection

@section('content')
<div class="row mb-3">
    <div class="col-md mb-3">
        @include('jobs.show.information')
    </div>

    <div class="col-md">
        @include('jobs.show.extensions')
    </div>
</div>

@include('jobs.show.modal-add-extension')
@include('jobs.show.modal-remove-extension')

@endsection
