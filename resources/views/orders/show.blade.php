@extends('application')

@section('header')
<x-header title="Order #{{ $order->id }}" :breadcrumbs="[
    'Back to orders' => route('orders.index'),
    'Order' => null,
]">
    <x-slot name="options">
        <x-custom.cursor-routes :prev="$prev_order ? route('orders.show', $prev_order) : false" :next="$next_order ? route('orders.show', $next_order) : false" />
    </x-slot>
</x-header>
@endsection

@section('content')
<div class="row">
    <div class="col-md mb-4">
        @include('orders.show.job')
    </div>
    <div class="col-md mb-4">
        @include('orders.show.client')
    </div>
    <div class="col-md mb-4">
        @include('orders.show.participants')
    </div>
</div>
<div class="row">
    <div class="col-md mb-4">
        @include('orders.show.timeline')
    </div>
    <div class="col-md mb-4">
        @include('orders.show.inspections')
    </div>
</div>
<div class="row">
    <div class="col-md mb-4">
        @include('orders.show.comments')
    </div>
    <div class="col-md mb-4">
        @include('orders.show.log')
    </div>
</div>
@include('orders.show.media')
@endsection
