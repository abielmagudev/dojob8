@extends('application')

@section('header')
<x-header title="Dashboard" />
@endsection

@section('content')
@include('dashboard.index.quantities')
<br>
@include('dashboard.index.statuses')
<br>
<div class="row">
    <div class="col-md">
        @include('dashboard.index.jobs')
    </div>
</div>
@endsection
