@extends('application')

@section('header')
<x-breadcrumb :items="[
    'Inspections' => route('inspections.index'),
    'Inspection',
]" />
<x-page-title>Inspection #{{ $inspection->id }}</x-page-title>
@endsection

@section('content')
<div class="row">
    {{-- Inspection --}}
    <div class="col-sm">
        @include('inspections.show.information')
    </div>

    {{-- Work order --}}
    <div class="col-sm">
        @include('inspections.show.work-order')
    </div>
</div>
@endsection
