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
        @csrf
        @method('put')
        @include('members._form')
        
        <x-form-field-horizontal for="isCrewMemberSelect">
            <div class="alert alert-warning">
                <div class="form-check form-switch">
                    <input class="form-check-input" id="isAvailableSwitch" type="checkbox" role="switch" name="is_available" value="1" {{ isChecked( old('is_available', $member->is_available) == 1 ) }}>
                    <label class="form-check-label" for="isAvailableSwitch">
                        <b class="d-block">Available</b>
                        <small>If deactivated, it will not be able to be used in new orders, it will be removed from your crew and your user account will be deactivated.</small>
                    </label>
                </div>
            </div>
            <x-form-feedback error="is_available" />
        </x-form-field-horizontal>
        <br>
        
        <div class="text-end">
            <a href="{{ route('members.show', $member) }}" class="btn btn-outline-primary">Back</a>
            <button class="btn btn-warning" type="submit">Update member</button>
        </div>
    </form>
</x-card>
<br>

<x-custom.modal-confirm-delete :route="route('members.destroy', $member)" concept="member">
    <p>¿Do you want to continue to delete the member <br> <b><?= $member->full_name ?> <?= $member->hasPosition() ? "({$member->position})" : '' ?></b>?</p>
</x-custom.modal-confirm-delete>
@endsection
