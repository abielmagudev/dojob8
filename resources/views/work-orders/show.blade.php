@extends('application')

@section('header')
<x-breadcrumb :items="[
    'Work orders' => route('work-orders.index'),
    'Work order',
]" />
<x-page-title>
    Work order #{{ $work_order->id }}
    @slot('subtitle')
    @include('clients.__.inline-summary-information', ['client' => $work_order->client])
    @endslot
</x-page-title>
@endsection

@section('content')
@include('work-orders.show._tabs')
@include("work-orders.show.{$show}")
@endsection
