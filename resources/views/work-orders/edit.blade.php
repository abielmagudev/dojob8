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
        @includeWhen(auth()->user()->hasAdminRole(), 'work-orders._form.timeline')
        @includeWhen(auth()->user()->hasAdminRole(), 'work-orders._form.status')
        <input type="hidden" name="url_back" value="{{ $request->get('url_back') }}">
        <br>

        <div class="d-flex justify-content-end gap-2">
            <a href="{{ $url_back }}" class="btn btn-outline-primary">Back</a>

            @if( auth()->user()->hasAdminRole() )
            <button class="btn btn-warning" type="submit">Update work order</button>
            @endif

            @includeWhen(auth()->user()->hasRole('worker'), 'work-orders._form.working-done')
        </div>
    </form>
</x-card>
<br>

@if( auth()->user()->can('delete-work-orders') )   
<x-custom.modal-confirm-delete :route="route('work-orders.destroy', $work_order)" concept="work order">
    <p>¿Do you want to continue to delete the work order <br> <b>#<?= $work_order->id ?> <?= $work_order->job->name ?></b>?</p>
    <div class="small">All related information like inspections, etc. will be deleted. <br><b class="text-danger">Cannot be recovered</b></div>
</x-custom.modal-confirm-delete>
@endif

@if( $work_order->job->hasExtensions() )

@push('scripts') 
@include('work-orders.scripts.extensionsLoader')
<script>
extensionsLoader.get("<?= route('work-orders.ajax.edit', $work_order) ?>")
</script>
@endpush

@endif

@endsection
