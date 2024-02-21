@extends('application')

@section('header')

<x-breadcrumb :items="[
    'Work orders' => route('work-orders.index'),
    'Work order',
]" />

<x-page-title>
    <span>#{{ $work_order->id }}</span>
    @if( $work_order->isNonstandard() )
    <span class="text-secondary text-capitalize fw-normal ">({{ $work_order->type }}: {{ $work_order->type_id }})</span>
    @endif

    @slot('subtitle')
    <div class="mb-3">
        @include('work-orders.__.flag-status', ['status' => $work_order->status])
        @include('work-orders.__.flag-inspection-status', ['status' => $work_order->inspection_status])
        @include('work-orders.__.flag-payment-status', ['status' => $work_order->payment_status])
    </div>
    @endslot
</x-page-title>

@include('work-orders.__.summary-client', ['client' => $work_order->client])

@endsection

@section('content')
@include('work-orders.show._tabs')
@include("work-orders.show.{$show}")
@endsection
