@extends('application')

@section('header')
<x-breadcrumb :items="[
    'Users' => route('users.index'),
    $user->name => route('users.show', $user),
    'Edit'
]" />
<x-page-title>{{ $user->name }}</x-page-title>
@endsection

@section('content')
<x-card title="Edit user">
    <form action="{{ route('users.update', $user) }}" method="post" autocomplete="off">
        @include('users._form')
        @method('put')

        <x-form-field-horizontal for="confirmPasswordInput">
            <div class="alert alert-warning">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="isActiveSwitch" name="is_active" value="1" {{ isChecked( $user->isActive() ) }}>
                    <label class="form-check-label" for="isActiveSwitch">
                        <b class="d-block">Active</b>
                        <small>If you deactivate this option, this user will not be able to access our application.</small>
                    </label>
                </div>
            </div>
        </x-form-field-horizontal>

        <br>
        <div class="text-end">
            <button class="btn btn-warning" type="submit">Update user</button>
            <a href="{{ route('users.show', $user) }}" class="btn btn-primary">Back</a>
        </div>
    </form>
</x-card>    
<br>

<x-custom.modal-confirm-delete :route="route('users.destroy', $user)" concept="user">
    <p>¿Do you want to continue to delete the user <br> <b><?= $user->name ?> ({{ $user->email }})</b>?</p>
</x-custom.modal-confirm-delete>
@endsection
