@extends('application')

@section('header')
<x-breadcrumb :items="[
    'Work orders' => route('work-orders.index'),
    'Work order',
]" />

<x-page-title>
    <span>#{{ $work_order->id }}</span>
    @if( $work_order->isNonstandard() )
    <span class="text-secondary text-capitalize fw-normal my-3">
        {{ $work_order->type }}: {{ $work_order->type_id }}
    </span>
    @endif
</x-page-title>
@include('work-orders.__.summary-client', ['client' => $work_order->client])
@endsection

@section('content')
@include('work-orders.show._tabs')
@include("work-orders.show.{$show}")
@endsection
