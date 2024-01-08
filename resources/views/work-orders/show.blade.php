@extends('application')

@section('header')
<x-header title="#{{ $work_order->id }}" :breadcrumbs="[
    'Back to work orders' => route('work-orders.index'),
    'Work order' => null,
]" />
@endsection

@section('content')
@include('work-orders.show._tabs')
@include("work-orders.show.{$show}")
@endsection
