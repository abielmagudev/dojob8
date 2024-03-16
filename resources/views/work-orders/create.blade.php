@extends('application')

@section('header')
<x-breadcrumb :items="[
    'Work orders' => route('work-orders.index'),
    'Create',
]" />
<x-page-title>Work order</x-page-title>
@endsection

@section('content')
<x-card title="New work order">
    <form action="{{ route('work-orders.store') }}" method="post" autocomplete="off">
        @csrf
        @include('work-orders.inc.form')
        @include('work-orders.inc.form.after-creating')
        <br>

        <x-form.box-action-buttons>
            <a href="{{ route('work-orders.index') }}" class="btn btn-dark">Cancel</a>
            <button class="btn btn-success" type="submit">Create work order</button>
        </x-form.box-action-buttons>
    </form>

</x-card>
@endsection
