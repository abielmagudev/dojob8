@extends('application')

@section('header')
<x-header title="Staff" :breadcrumbs="[
    'Back to staff' => route('members.index'),
    $member->fullname => route('members.show', $member),
    'Edit' => null,
]" />
@endsection

@section('content')
<x-card title="Edit member">
    <form action="{{ route('members.update', $member) }}" method="post" autocomplete="off">
        @include('members._form')
        @method('put')
        <br>
        <div class="text-end">
            <button class="btn btn-warning" type="submit">Update member</button>
            <a href="{{ route('members.show', $member) }}" class="btn btn-primary">Back</a>
        </div>
    </form>
</x-card>
<br>
<x-custom.modal-confirm-delete :route="route('members.destroy', $member)" concept="member">
    <p>¿Do you want to continue to delete the member <br> <b><?= $member->fullname ?> (role)</b>?</p>
</x-custom.modal-confirm-delete>

@include('members._modal-help-categories')
@include('members._modal-help-scopes')

@endsection
