@extends('application')

@section('header')
<x-breadcrumb :items="[
    'Inspectors' => route('inspectors.index'),
    'Inspector'
]" />
<x-page-title>{{ $inspector->name }}</x-page-title>
@endsection

@section('content')
<div class="row">
    <div class="col-sm col-sm-4 mb-3">
        @include('inspectors.show.information')
    </div>
    <div class="col-sm col-sm-8 mb-3">
        @include('inspectors.show.inspections')
    </div>
</div>
@endsection
