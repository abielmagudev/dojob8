@extends('application')

@section('header')

<x-breadcrumb :items="[
    'Work orders' => route('work-orders.index'),
    'Work order',
]" />

<x-page-title>
    <span>#{{ $work_order->id }}</span>
    @if( $work_order->isNonstandard() )
    <span class="text-secondary text-capitalize fw-normal ">({{ $work_order->type }})</span>
    @endif

    @slot('subtitle')
    <div class="mb-3">
        @include('work-orders.__.status-flag', ['status' => $work_order->status])
    </div>
    @endslot
</x-page-title>

@include('work-orders.__.client', ['client' => $work_order->client])

@endsection

@section('content')
@include('work-orders.show._tabs')
@include("work-orders.show.{$show}")
@endsection
