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
            <x-custom.switch-active-status :toggle="$crew->isActive()">
                <b class="d-block">Active.</b> 
                <small>If it is deactivated, it cannot be used in new work orders and the members of this crew will be removed.</small>
            </x-custom.switch-active-status>
        </x-form-field-horizontal>
        <br>
        
        <div class="text-end">
            <a href="{{ route('crews.show', $crew) }}" class="btn btn-outline-primary">Back</a>
            <button class="btn btn-warning" type="submit">Update crew</button>
        </div>
    </form>
</x-card>
<br>

<x-custom.modal-confirm-delete :route="route('crews.destroy', $crew)" concept="crew">
    <p>¿Do you want to continue to delete the crew <br> <b><?= $crew->name ?></b>?</p>
</x-custom.modal-confirm-delete>
@endsection
