@extends('application')

@section('header')
<x-breadcrumb :items="[
    'Back to Work orders' => route('work-orders.index'),
    'Work order',
]" />
<x-page-title>Work order #{{ $work_order->id }}</x-page-title>
@endsection

@section('content')
@include('work-orders.show._tabs')
@include("work-orders.show.{$show}")
@endsection
