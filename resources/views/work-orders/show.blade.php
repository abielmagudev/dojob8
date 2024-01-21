@extends('application')

@section('header')
<x-breadcrumb :items="[
    'Work orders' => route('work-orders.index'),
    'Work order',
]" />
<x-page-title>
    Work order #{{ $work_order->id }}
    @slot('subtitle')
        <div class="mb-3">
            @include('work-orders.__.status-flag', ['status' => $work_order->status])
            @if( $work_order->isBound() )
            <span class="text-secondary text-capitalize align-middle ms-1">{{ $work_order->type }}</span>
            @endif
        </div>
        @include('clients.__.inline-summary-information', ['client' => $work_order->client])
        <a href="{{ route('clients.show', $work_order->client) }}" class="text-decoration-none small">See client</a>
    @endslot
</x-page-title>
@endsection

@section('content')
@include('work-orders.show._tabs')
@include("work-orders.show.{$show}")
@endsection
