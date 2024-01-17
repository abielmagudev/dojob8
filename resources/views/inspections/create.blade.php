@extends('application')

@section('header')
<x-breadcrumb :items="[
    'Inspections' => route('inspections.index'),
    'Create',
]" />
<x-page-title>Inspections</x-page-title>
@endsection

@section('content')
<x-card title="New inspection">
    <form action="{{ route('inspections.store') }}" method="post" autocomplete="off">
        @include('inspections._form')
        <input type="hidden" name="work_order" value="{{ $work_order->id }}">
        <br>

        <div class="text-end">
            <button class="btn btn-success" type="submit">Create inspection</button>
            <a href="{{ route('work-orders.show', [$work_order, 'tab' => 'inspections']) }}" class="btn btn-primary">Cancel</a>
        </div>
    </form>
</x-card>
@endsection
