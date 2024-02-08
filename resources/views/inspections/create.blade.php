@extends('application')

@section('header')
<x-breadcrumb :items="[
    'Inspections' => route('inspections.index'),
    'Create',
]" />
<x-page-title>
    Inspections
    @slot('subtitle')
    <div>
        <a href="{{ route('work-orders.show', [$work_order, 'tab' => 'inspections']) }}" class="text-decoration-none">
            Work order #{{ $work_order->id }} - {{ $work_order->job->name }}
        </a>
    </div>
    @endslot
</x-page-title>
@endsection

@section('content')
<x-card title="New inspection">
    <form action="{{ route('inspections.store') }}" method="post" autocomplete="off">
        @csrf
        @include('inspections._form')
        <input type="hidden" name="work_order" value="{{ $work_order->id }}">
        <br>

        <div class="text-end">
            <a href="{{ route('work-orders.show', [$work_order, 'tab' => 'inspections']) }}" class="btn btn-outline-primary">Cancel</a>
            <button class="btn btn-success" type="submit">Create inspection</button>
        </div>
    </form>
</x-card>
@endsection
