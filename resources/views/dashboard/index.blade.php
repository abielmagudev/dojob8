@extends('application')

@section('header')
<x-header title="Dashboard" />
@endsection

@section('content')
@include('dashboard.index.quantities')
<br>
@include('dashboard.index.status')
<br>
@endsection
