@extends('application')
@section('header')

<x-breadcrumb :items="[
    'Work orders' => route('work-orders.index'),
    sprintf(' %s ', $work_order->id) => route('work-orders.show', $work_order),
    'Edit',
]" />

<x-page-title>Work order #{{ $work_order->id }}</x-page-title>

@include('work-orders.__.summary-client', ['client' => $work_order->client])

@endsection

@section('content')
<x-card title="Edit work order">
    <form action="{{ route('work-orders.update', $work_order) }}" method="post" autocomplete="off">
        @method('patch')
        @csrf
        @include('work-orders._form')
        @include('work-orders._form.timeline')
        @include('work-orders._form.status')
        <input type="hidden" name="url_back" value="{{ $request->get('url_back') }}">
        <br>

        <div class="text-end">
            <a href="{{ $url_back }}" class="btn btn-outline-primary">Back</a>
            <button class="btn btn-warning" type="submit">Update work order</button>
        </div>
    </form>
</x-card>
<br>

<x-custom.modal-confirm-delete :route="route('work-orders.destroy', $work_order)" concept="work order">
    <p>¿Do you want to continue to delete the work order <br> <b>#<?= $work_order->id ?> <?= $work_order->job->name ?></b>?</p>
</x-custom.modal-confirm-delete>

@if( $work_order->job->hasExtensions() )
@push('scripts') 
@include('work-orders.scripts.extensionsLoader')

<script>
extensionsLoader.get("<?= route('work-orders.ajax.edit', $work_order) ?>")
</script>

@endpush
@endif

@endsection
