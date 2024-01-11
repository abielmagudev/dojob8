@extends('application')

@section('header')
<x-breadcrumb :items="[
    'Back to Work orders' => route('work-orders.index'),
    sprintf('#%s', $work_order->id) => route('work-orders.show', $work_order),
    'Edit',
]" />
<x-page-title>Work order #{{ $work_order->id }}</x-page-title>
@endsection

@section('content')
<div class="row">
    <div class="col-sm">
        <x-card title="Edit work order">
            <form action="{{ route('work-orders.update', $work_order) }}" method="post">
                @include('work-orders._form')
                @method('patch')
                <br>
                <div class="text-end">
                    <button class="btn btn-warning" type="submit">Update work order</button>
                    <a href="{{ route('work-orders.index') }}" class="btn btn-primary">Back</a>
                </div>
            </form>
        </x-card>
    </div>
    <div class="col-sm col-sm-3">
        <x-card title="Client" class="h-100">
            @include('clients.__.address', ['client' => $work_order->client])
            <br>
            {{ $client->contact_data_collection->filter()->implode(', ') }}
        </x-card>
    </div>
</div>

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
