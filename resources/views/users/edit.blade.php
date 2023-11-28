@extends('application')

@section('header')
<x-header title="Users" :breadcrumbs="[
    'Back to users' => route('users.index'),
    $user->name => route('users.show', $user),
    'Edit' => null
]" />
@endsection

@section('content')
<x-card title="Edit user">
    <form action="{{ route('users.update', $user) }}" method="post" autocomplete="off">
        @include('users._form')
        @method('put')
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
