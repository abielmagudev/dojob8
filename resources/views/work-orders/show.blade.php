@extends('application')

@section('header')
<x-header title="Work order #{{ $work_order->id }}" :breadcrumbs="[
    'Back to work orders' => route('work-orders.index'),
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
        @include('work-orders.show.information')
    </div>
    <div class="col-md mb-4">
        @include('work-orders.show.participants')
    </div>
    <div class="col-md mb-4">
        @include('work-orders.show.timeline')
    </div>
</div>

@include('work-orders.show.inspections')
<br>

@include('work-orders.show.media')
<br>

<div class="row">
    <div class="col-md mb-4">
        @include('work-orders.show.comments')
    </div>
    <div class="col-md mb-4">
        @include('work-orders.show.history')
    </div>
</div>
@endsection
