@extends('application')

@section('header')
<x-header title="Work order #{{ $order->id }}" :breadcrumbs="[
    'Back to work orders' => route('orders.index'),
    'Work order' => null,
]">
    <x-slot name="options">
        <x-paginate
            :previous="$routes['previous']"
            :next="$routes['next']"
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
