@csrf

<x-form-field-horizontal label="Profile type">
    <div class="form-control bg-light text-capitalize">{{ $alias }}</div>
    <x-error name="profile_alias" />
    <x-error name="profile_id" />
</x-form-field-horizontal>

<x-form-field-horizontal label="Profile name">
    <div class="form-control bg-light">{{ $profile->authenticated_name }}</div>
    <x-error name="profile_alias" />
    <x-error name="profile_id" />
</x-form-field-horizontal>

<x-form-field-horizontal for="nameInput"> 
    <x-slot name="label">
        <span>Username</span>
        <x-tooltip title="
            <span>Minimum 6 characters.</span><br>
            <span>Use letters, numbers, underscores and dots.</span>
        " 
        html>
            <span class="link-primary">
                <i class="bi bi-info-circle"></i>
            </span>
        </x-tooltip>
    </x-slot>

    <input id="nameInput" type="text" class="form-control {{ bsInputInvalid( $errors->has('name') ) }}" name="name" value="{{ old('name', $user->name) }}" required>
    <x-error name="name" />
</x-form-field-horizontal>

<x-form-field-horizontal for="emailInput" label="Email">
    <input id="emailInput" type="email" class="form-control {{ bsInputInvalid( $errors->has('email') ) }}" name="email" value="{{ old('email', $user->email) }}" required>
    <x-error name="email" />
</x-form-field-horizontal>

<x-form-field-horizontal for="passwordInput" label="Password" label-class="{{ $user->id ? 'form-label-optional' : '' }}">
    <input id="passwordInput" type="password" class="form-control {{ bsInputInvalid( $errors->has('password') ) }}" name="password" @if( is_null($user->id) ) required @endif placeholder="Minimum 8 characters">
    <x-error name="password" />
</x-form-field-horizontal>

<x-form-field-horizontal for="confirmPasswordInput" label="Confirm password">
    <input id="confirmPasswordInput" type="password" class="form-control {{ bsInputInvalid( $errors->has('confirm_password') ) }}" name="confirm_password" @if( is_null($user->id) ) required @endif>
    <x-error name="confirm_password" />
</x-form-field-horizontal>

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
