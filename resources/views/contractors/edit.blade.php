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
        @csrf
        @method('put')
        @include('contractors._form')
        <x-form-field-horizontal>
            <x-custom.switch-active-status :toggle="$contractor->isActive()">
                <b>Active</b>
                <small class="d-block">If you deactivate this option, you will not be able to use this contractor for new orders and all of his user accounts will also be deactivated.</small>
            </x-custom.switch-active-status>
        </x-form-field-horizontal>
        <br>

        <div class="text-end">
            <a href="{{ route('contractors.show', $contractor) }}" class="btn btn-outline-primary">Cancel</a>
            <button type="submit" class="btn btn-warning">Update contractor</button>
        </div>
    </form>
</x-card>
<br>

<x-custom.modal-confirm-delete :route="route('contractors.destroy', $contractor)" concept="contractor">
    <p>¿Do you want to continue to delete the intermediary <br> <b><?= $contractor->name ?> ({{ $contractor->alias }})</b>?</p>
</x-custom.modal-confirm-delete>
@endsection
