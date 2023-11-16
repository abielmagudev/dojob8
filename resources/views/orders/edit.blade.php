@extends('application')

@section('header')
<x-header title="Order #{{ $order->id }}" :breadcrumbs="[
    'Back to orders' => route('orders.index'),
    $order->id => route('orders.show', $order),
    'Edit' => null,
]" />
@endsection

@section('content')
<x-card title="Edit order">
    <form action="{{ route('orders.update', $order) }}" method="post">
        @include('orders._form')
        @method('patch')
        <br>
        <div class="text-end">
            <button class="btn btn-warning" type="submit">Update order</button>
            <a href="{{ route('orders.index') }}" class="btn btn-primary">Back</a>
        </div>
    </form>
</x-card>
<br>

<x-custom.modal-confirm-delete :route="route('orders.destroy', $order)" concept="order">
    <p>¿Do you want to continue to delete the order <br> <b>#<?= $order->id ?> <?= $order->job->name ?></b>?</p>
</x-custom.modal-confirm-delete>

@if( $order->job->hasExtensions() )
@push('scripts') 
@include('orders.scripts.extensionsLoader')

<script>
extensionsLoader.get("<?= route('orders.ajax.edit', $order) ?>")
</script>

@endpush
@endif

@endsection
