@extends('application')

@section('header')
<x-breadcrumb :items="[
    'Work orders' => route('work-orders.index'),
    sprintf(' %s ', $work_order->id) => route('work-orders.show', $work_order),
    'Edit',
]" />
<x-page-title>Work order #{{ $work_order->id }}</x-page-title>
@endsection

@section('content')
<x-card title="Edit work order">
    <form action="{{ route('work-orders.update', $work_order) }}" method="post" autocomplete="off">
        @method('patch')
        @csrf
        @include('work-orders.inc.form')
        @includeWhen(auth()->user()->can('edit-work-orders'), 'work-orders.inc.form.timeline')
        @includeWhen(auth()->user()->can('edit-work-orders'), 'work-orders.inc.form.status')
        <input type="hidden" name="url_back" value="{{ $request->get('url_back') }}">
        <br>

        <x-form.box-action-buttons>
            <a href="{{ $url_back }}" class="btn btn-dark">Back</a>

            @can('edit-work-orders')          
            <button class="btn btn-warning" type="submit">Update work order</button>
            @endcan

            @includeWhen(auth()->user()->hasRole('crew-member'), 'work-orders.inc.form.working-done')
        </x-form.box-action-buttons>
    </form>
</x-card>
<br>

@if( auth()->user()->can('delete-work-orders') )   
<x-custom.modal-confirm-delete :route="route('work-orders.destroy', $work_order)" concept="work order">
    <p>¿Do you want to continue to delete the work order <br> <b>#<?= $work_order->id ?> <?= $work_order->job->name ?></b>?</p>
    <div class="small">All related information like inspections, etc. will be deleted. <br><b class="text-danger">Cannot be recovered</b></div>
</x-custom.modal-confirm-delete>
@endif

@endsection
