@extends('application')

@section('header')
<x-header title="Intermediaries" :breadcrumbs="[
    'Back to intermediaries' => route('intermediaries.index'),
    $intermediary->name => route('intermediaries.show', $intermediary),
    'Edit' => null
]" />
@endsection

@section('content')
<x-card title="Edit intermediary">
    <form action="{{ route('intermediaries.update', $intermediary) }}" method="post" autocomplete="off">
        @include('intermediaries._form')
        @method('put')
        <div class="row mb-3">
            <div class="col-md"></div>
            <div class="col-md col-md-9 col-lg-10">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="availableSwitch" name="available" value="1" {{ isChecked( $intermediary->isAvailable() ) }}>
                    <label class="form-check-label" for="availableSwitch">
                        <b class="d-block">Available</b>
                        <small>If you deactivate this option, you will not be able to use this intermediary for new orders and all of his user accounts will also be deactivated.</small>
                    </label>
                </div>
            </div>
        </div>
        <br>
        <div class="text-end">
            <button type="submit" class="btn btn-warning">Update intermediary</button>
            <a href="{{ route('intermediaries.show', $intermediary) }}" class="btn btn-primary">Back</a>
        </div>
    </form>
</x-card>
<br>
<x-custom.modal-confirm-delete :route="route('intermediaries.destroy', $intermediary)" concept="intermediary">
    <p>¿Do you want to continue to delete the intermediary <br> <b><?= $intermediary->name ?> ({{ $intermediary->alias }})</b>?</p>
</x-custom.modal-confirm-delete>
@endsection
