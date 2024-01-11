@extends('application')

@section('header')
<x-breadcrumb :items="[
    'Back to Inspections' => route('inspections.index'),
    sprintf('#%s', $inspection->id) => route('inspections.show', $inspection),
    'Edit'
]" />
<x-page-title>Inspection #{{ $inspection->id }}</x-page-title>
@endsection

@section('content')
<x-card title="Edit inspection">
    <form action="{{ route('inspections.update', $inspection) }}" method="post" autocomplete="off">
        @include('inspections._form')
        @method('put')
        <br>
        <div class="text-end">
            <button class="btn btn-warning" type="submit">Update inspection</button>
            <a href="{{ $url_back }}" class="btn btn-primary">Back</a>
        </div>
    </form>
</x-card>
<br>

<x-custom.modal-confirm-delete :route="route('inspections.destroy', $inspection)" concept="inspection">
    <p>¿Do you want to continue to delete <br> the inspection <b><?= $inspection->id ?></b> of <b>Order #{{ $inspection->order_id }}</b>?</p>
</x-custom.modal-confirm-delete>
@endsection
