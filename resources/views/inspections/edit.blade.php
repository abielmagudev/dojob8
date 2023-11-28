@extends('application')

@section('header')
<x-header title="Inspections" :breadcrumbs="[
    'Back to inspections' => route('inspections.index'),
    'Inspection ' . $inspection->id => route('inspections.show', $inspection),
    'Edit' => null
]" />
@endsection

@section('content')
<x-card title="Edit inspection">
    <form action="{{ route('inspections.update', $inspection) }}" method="post" autocomplete="off">
        @include('inspections._form')
        @method('put')
        <br>
        <div class="text-end">
            <button class="btn btn-warning" type="submit">Update inspection</button>
            <a href="{{ route('work-orders.show', $inspection->work_order_id) }}" class="btn btn-primary">Back</a>
        </div>
    </form>
</x-card>
<br>

<x-custom.modal-confirm-delete :route="route('inspections.destroy', $inspection)" concept="inspection">
    <p>¿Do you want to continue to delete <br> the inspection <b><?= $inspection->id ?></b> of <b>Order #{{ $inspection->order_id }}</b>?</p>
</x-custom.modal-confirm-delete>
@endsection
