@csrf

<x-form-field-horizontal label="Profile type">
    <input class="form-control text-capitalize" value="{{ $user->profile_alias }}" disabled>
    <x-error name="profile_alias" />
    <x-error name="profile_id" />
</x-form-field-horizontal>

<x-form-field-horizontal label="Profile name">
    <input class="form-control" value="{{ $user->profile->authenticated_name }}" disabled>
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
