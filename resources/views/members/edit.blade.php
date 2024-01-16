@extends('application')

@section('header')
<x-breadcrumb :items="[
    'Members' => route('members.index'),
    $member->full_name => route('members.show', $member),
    'Edit',
]" />
<x-page-title>{{ $member->full_name }}</x-page-title>
@endsection

@section('content')
<x-card title="Edit member">
    <form action="{{ route('members.update', $member) }}" method="post" autocomplete="off">
        @include('members._form')
        @method('put')
        <x-form-field-horizontal for="isCrewMemberSelect">
            <div class="alert alert-warning">
                <div class="form-check form-switch">
                    <input class="form-check-input" id="isActiveSwitch" type="checkbox" role="switch" name="is_active" value="1" {{ isChecked( old('is_active', $member->is_active) == 1 ) }}>
                    <label class="form-check-label" for="isActiveSwitch">
                        <b class="d-block">Active</b>
                        <small>If deactivated, it will not be able to be used in new orders, it will be removed from your crew and your user account will be deactivated.</small>
                    </label>
                </div>
            </div>
            <x-error name="is_active" />
        </x-form-field-horizontal>
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

@endsection
