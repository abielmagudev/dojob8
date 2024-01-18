@extends('application')

@section('header')
<x-breadcrumb :items="[
    'Inspections' => route('inspections.index'),
    'Inspection',
]" />
<x-page-title>
    Inspection #{{ $inspection->id }}
    @slot('subtitle')
    <div>
        <a href="{{ route('work-orders.show', [$inspection->work_order, 'tab' => 'inspections']) }}">
            Work order #{{ $inspection->work_order->id }} - {{ $inspection->work_order->job->name }}
        </a>
    </div>
    @endslot
</x-page-title>
@endsection

@section('content')
@include('inspections.show.information')
@endsection
