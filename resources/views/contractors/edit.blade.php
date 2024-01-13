@extends('application')

@section('header')
<x-breadcrumb :items="[
    'Contractors' => route('contractors.index'),
    $contractor->name => route('contractors.show', $contractor),
    'Edit'
]" />
<x-page-title>{{ $contractor->name }}</x-page-title>
@endsection

@section('content')
<x-card title="Edit contractor">
    <form action="{{ route('contractors.update', $contractor) }}" method="post" autocomplete="off">
        @method('put')
        @include('contractors._form')
        <x-form-field-horizontal for="availableSwitch">
            <div class="alert alert-warning">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="availableSwitch" name="available" value="1" {{ isChecked( $contractor->isAvailable() ) }}>
                    <label class="form-check-label" for="availableSwitch">Available</label>
                    <small class="d-block">If you deactivate this option, you will not be able to use this contractor for new orders and all of his user accounts will also be deactivated.</small>
                </div>
            </div>
        </x-form-field-horizontal>
        <br>
        <div class="text-end">
            <button type="submit" class="btn btn-warning">Update contractor</button>
            <a href="{{ route('contractors.show', $contractor) }}" class="btn btn-primary">Back</a>
        </div>
    </form>
</x-card>
<br>

<x-custom.modal-confirm-delete :route="route('contractors.destroy', $contractor)" concept="contractor">
    <p>¿Do you want to continue to delete the intermediary <br> <b><?= $contractor->name ?> ({{ $contractor->alias }})</b>?</p>
</x-custom.modal-confirm-delete>
@endsection
