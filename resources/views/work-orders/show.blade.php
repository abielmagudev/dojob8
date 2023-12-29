@extends('application')

@section('header')
<x-header title="#{{ $work_order->id }}" :breadcrumbs="[
    'Back to work orders' => route('work-orders.index'),
    'Work order' => null,
]">
    <x-slot name="options">
        <?php $previous_work_order = $work_order->before() ?>
        <?php $next_work_order = $work_order->after() ?>
        <x-paginate
            :previous="$previous_work_order ? route('work-orders.show', $previous_work_order) : false" 
            :next="$next_work_order ? route('work-orders.show', $next_work_order) : false" 
        />
    </x-slot>
</x-header>
@endsection

@section('content')
@include('work-orders.show._tabs')
@include("work-orders.show.{$tab}")
@endsection
