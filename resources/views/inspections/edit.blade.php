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
        <x-custom.form-control-horizontal class="align-items-center">
            <x-slot name="label">
                <label for="statusSelect" class="form-label">Status</label>
            </x-slot>
        
            <select id="statusSelect" class="form-select" name="status">
                @foreach($inspection::getAllStatus() as $key => $label)
                <option value="{{ $key }}" {{ isSelected( ($key === $inspection->status) ) }}>{{ ucfirst($label) }}</option>
                @endforeach
            </select>
        </x-custom.form-control-horizontal>
        @include('inspections._form')
        @method('put')
        <br>
        <div class="text-end">
            <button class="btn btn-warning" type="submit">Update inspection</button>
            <a href="{{ $back }}" class="btn btn-primary">Back</a>
        </div>
    </form>
</x-card>
<br>
<x-custom.modal-confirm-delete :route="route('inspections.destroy', $inspection)" concept="inspection">
    <p>¿Do you want to continue to delete the inspection <br> <b><?= $inspection->id ?></b> of <b>Order #{{ $inspection->order_id }}</b>?</p>
</x-custom.modal-confirm-delete>
@endsection
