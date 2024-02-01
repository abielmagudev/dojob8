@extends('application')

@section('header')
<x-breadcrumb :items="[
    'Crews' => route('crews.index'),
    $crew->name => route('crews.show', $crew),
    'Edit',
]" />
<x-page-title>{{ $crew->name }}</x-page-title>
@endsection

@section('content')
<x-card title="Edit crew">
    <form action="{{ route('crews.update', $crew) }}" method="post" autocomplete="off">
        @include('crews._form')
        @method('put')
        <x-form-field-horizontal>
            <div class="alert alert-warning">
                <div class="form-check form-switch">
                    <input class="form-check-input" id="isActiveSwitch" type="checkbox" role="switch" name="is_active" value="1" {{ isChecked( old('is_active', $crew->is_active) == 1 ) }}>
                    <label class="form-check-label" for="isActiveSwitch">
                        <b>Active.</b> 
                        <small>If it is deactivated, it cannot be used in new work orders and the members of this crew will be removed.</small>
                    </label>
                </div>
            </div>
            <x-form-feedback error="is_active" />
        </x-form-field-horizontal>
        <br>
        <div class="text-end">
            <button class="btn btn-warning" type="submit">Update crew</button>
            <a href="{{ route('crews.show', $crew) }}" class="btn btn-primary">Back</a>
        </div>
    </form>
</x-card>
<br>

<x-custom.modal-confirm-delete :route="route('crews.destroy', $crew)" concept="crew">
    <p>¿Do you want to continue to delete the crew <br> <b><?= $crew->name ?></b>?</p>
</x-custom.modal-confirm-delete>
@endsection
