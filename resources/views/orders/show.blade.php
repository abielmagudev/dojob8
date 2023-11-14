@extends('application')

@section('header')
<x-header title="Order #{{ $order->id }}" :breadcrumbs="[
    'Back to orders' => route('orders.index'),
    'Show' => '#!',
]" />
@endsection

@section('content')
<div class="row">
    <div class="col-sm">
        <x-card title="Information">    
            <small>Job</small>
            <p>{{ $order->job->name }}</p>
        
            <small>Scheduled</small>
            <p>{{ $order->full_scheduled_human }}</p>
            
            <small>Timeline</small>
            <p>Created, Started, finished, closed, updated...</p>
            
            <small>Media</small>
            <p>All files and photos</p>
        </x-card>
    </div>
    <div class="col-sm">
        <x-card title="Timelines">    
            <small>Timeline</small>
            <p>Created, Started, finished, closed, updated...</p>
        </x-card>
    </div>
    <div class="col-sm">
        <x-card title="Archives">    
            <small>Media</small>
            <p>All files and photos</p>
        </x-card>
    </div>
</div>
@endsection
