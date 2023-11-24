@extends('application')

@section('header')
<x-header title="Order #{{ $order->id }}" :breadcrumbs="[
    'Back to orders' => route('orders.index'),
    'Order' => null,
]">
    <x-slot name="options">
        <x-paginate 
            :previous="$prev_order ? route('orders.show', $prev_order) : false" 
            :next="$next_order ? route('orders.show', $next_order) : false" 
        />
    </x-slot>
</x-header>
@endsection

@section('content')
<div class="row">
    <div class="col-md mb-4">
        @include('orders.show.information')
    </div>
    <div class="col-md mb-4">
        @include('orders.show.participants')
    </div>
    <div class="col-md mb-4">
        @include('orders.show.timeline')
    </div>
</div>

@include('orders.show.inspections')
<br>
@include('orders.show.media')
<br>

<div class="row">
    <div class="col-md mb-4">
        @include('orders.show.comments')
    </div>
    <div class="col-md mb-4">
        @include('orders.show.log')
    </div>
</div>
@endsection
