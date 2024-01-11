@extends('application')

@section('header')
<x-page-title>Dashboard</x-page-title>
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
