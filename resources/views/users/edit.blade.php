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
        @method('put')
        @csrf

        <x-form-field-horizontal label="Profile">
            <div class="form-control text-capitalize">{{ $user->profile_name }} ({{ $user->profile_classnickname }})</div>
        </x-form-field-horizontal>

        @include('users._form')

        <x-form-field-horizontal for="confirmPasswordInput">
            <x-custom.switch-active-status :toggle="$user->isActive()">
                <b class="d-block">Active</b>
                        <small>If you deactivate this option, this user will not be able to access our application.</small>
            </x-custom.switch-active-status>
        </x-form-field-horizontal>

        <br>
        <div class="text-end">
            <a href="{{ route('users.show', $user) }}" class="btn btn-outline-primary">Cancel</a>
            <button class="btn btn-warning" type="submit">Update user</button>
        </div>
    </form>
</x-card>    
<br>

<x-custom.modal-confirm-delete :route="route('users.destroy', $user)" concept="user">
    <p>¿Do you want to continue to delete the user <br> <b><?= $user->name ?> ({{ $user->email }})</b>?</p>
</x-custom.modal-confirm-delete>
@endsection
