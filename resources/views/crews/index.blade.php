@extends('application')

@section('header')
<x-header title="Crews" />
@endsection

@section('content')

@include("crews.index.{$show}")

@include('crews.index._modal-set-crew-members-script')
@include('crews.index._modal-update-work-order-operators')

@endsection
