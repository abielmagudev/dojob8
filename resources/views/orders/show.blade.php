@extends('application')
@section('content')
<x-card title="Work Order #{{ $order->id }}">
    <small>Job</small>
    <p>{{ $order->job->name }}</p>
    
    <small>Scheduled</small>
    <p>{{ $order->full_scheduled_human }}</p>
    
    <small>Timeline</small>
    <p>Created, Started, finished, closed, updated...</p>
    
    <small>Media</small>
    <p>All files and photos</p>
</x-card>
@endsection
