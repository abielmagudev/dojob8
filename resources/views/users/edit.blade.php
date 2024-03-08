@extends('application')

@section('header')
<x-breadcrumb :items="[
    'Users' => route('users.index'),
    $user->name => route('users.show', $user),
    'Edit'
]" />
<x-page-title subtitle="{{ ucfirst($user->profile_classnickname) }}">{{ $user->name }}</x-page-title>
@endsection

@section('content')
<x-card title="Edit user">
    <form action="{{ route('users.update', $user) }}" method="post" autocomplete="off">
        @method('put')
        @csrf
        @include('users.includes.form')

        <x-form-field-horizontal for="confirmPasswordInput">
            <x-custom.switch-active-status :toggle="$user->isActive()">
                <b>Active.</b> 
                <small>If you deactivate this option, this user will not be able to access our application.</small>
            </x-custom.switch-active-status>
        </x-form-field-horizontal>

        <br>
        <div class="d-flex gap-2 justify-content-end align-items-center">
            <a href="{{ $url_back }}" class="btn btn-outline-primary">Cancel</a>
            <button class="btn btn-warning" type="submit">Update user</button>
        </div>
    </form>
</x-card>    
<br>

<x-custom.modal-confirm-delete :route="route('users.destroy', $user)" concept="user">
    <p>¿Do you want to continue to delete the user <br> <b><?= $user->name ?> ({{ $user->email }})</b>?</p>
</x-custom.modal-confirm-delete>
@endsection
