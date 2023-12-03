@extends('application')

@section('header')
<x-header title="Dashboard" />
@endsection

@section('content')
@include('dashboard.index.quantities')
<br>
@include('dashboard.index.statuses')
<br>
@include('dashboard.index.jobs')
<br>
@include('dashboard.index.inspections')
@endsection
