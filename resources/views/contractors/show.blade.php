@extends('application')

@section('header')
<x-breadcrumb :items="[
    'Contractors' => route('contractors.index'),
    'Contractor',
]" />
<x-page-title>{{ $contractor->name }} ({{ $contractor->alias }})</x-page-title>
@endsection

@section('content')
<div class="row">
    <div class="col-sm">
        @include('contractors.show.information')
    </div>

    <div class="col-sm">
        @include('contractors.show.user-accounts')
    </div>
</div>
<br>

@include('contractors.show.work-orders')
@endsection
