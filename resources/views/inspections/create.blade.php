@extends('application')

@section('header')
<x-header title="Inspections" :breadcrumbs="[
    'Back to inspections' => route('inspections.index'),
    'Create' => null,
]" />
@endsection

@section('content')
<x-card title="New inspection">
    <form action="{{ route('inspections.store') }}" method="post" autocomplete="off">
        @include('inspections._form')
        <input type="hidden" name="order" value="{{ $order->id }}">
        <br>
        <div class="text-end">
            <button class="btn btn-success" type="submit">Save inspection</button>
            <a href="{{ route('orders.show', $order) }}" class="btn btn-primary">Cancel</a>
        </div>
    </form>
</x-card>
@endsection
