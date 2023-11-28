@csrf

<x-form-control-horizontal>
    <x-slot name="label">
        <label class="form-label mt-1">Profile</label>
    </x-slot>
    <div class="form-control">
        <div>{{ $profile->meta_name }}</div>
        <small>{{ ucfirst($alias) }}</small>
    </div>
    <x-error name="profile_alias" />
    <x-error name="profile_id" />
</x-form-control-horizontal>

<x-form-control-horizontal>
    <x-slot name="label">
        <label for="nameInput" class="form-label mt-1">Name</label>
    </x-slot>
    
    <input id="nameInput" type="text" class="form-control {{ bsInputInvalid( $errors->has('name') ) }}" name="name" value="{{ old('name', $user->name) }}" required>
    <x-error name="name" important>
        Minimum 6 characters, only alphanumeric, underscores and dots
    </x-error>
</x-form-control-horizontal>

<x-form-control-horizontal class="align-items-center">
    <x-slot name="label">
        <label for="emailInput" class="form-label">Email</label>
    </x-slot>

    <input id="emailInput" type="email" class="form-control {{ bsInputInvalid( $errors->has('email') ) }}" name="email" value="{{ old('email', $user->email) }}" required>
    <x-error name="email" />
</x-form-control-horizontal>

<x-form-control-horizontal>
    <x-slot name="label">
        <label for="passwordInput" class="mt-1 form-label {{ $user->id ? 'form-label-optional' : '' }}">Password</label>
    </x-slot>

    <input id="passwordInput" type="password" class="form-control {{ bsInputInvalid( $errors->has('password') ) }}" name="password" @if( is_null($user->id) ) required @endif>
    <x-error name="password">Minimum 8 characters</x-error>
</x-form-control-horizontal>

<x-form-control-horizontal class="align-items-center">
    <x-slot name="label">
        <label for="confirmPasswordInput" class="form-label">Confirm password</label>
    </x-slot>

    <input id="confirmPasswordInput" type="password" class="form-control {{ bsInputInvalid( $errors->has('confirm_password') ) }}" name="confirm_password" @if( is_null($user->id) ) required @endif>
    <x-error name="confirm_password" />
</x-form-control-horizontal>

@if( $user->id )
<br>
<div class="mb-3">
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" role="switch" id="isActiveSwitch" name="is_active" value="1" {{ isChecked( $user->isActive() ) }}>
        <label class="form-check-label" for="isActiveSwitch">
            <b>Active.</b>
            <span>If you deactivate this option, this user will not be able to access our application.</span>
        </label>
    </div>
</div>
@endif
