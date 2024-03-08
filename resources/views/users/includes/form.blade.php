<?php $fake = is_null($user->id) ?>

@if( $roles->count() > 1 )
<x-form-field-horizontal for="roleSelect" label="Role" class="mb-4">
    <select name="role" id="roleSelect" class="form-select">
        @foreach($roles->reverse() as $role)             
        <option value="{{ $role }}" {{ isSelected( $role == old('role', $user->roles()->first()->name ?? false) ) }}>{{ ucfirst($role) }}</option>
        @endforeach
    </select>
    <x-form-feedback error="role" />
</x-form-field-horizontal>
   
@else
<input type="hidden" name="role" value="{{ $roles->first() }}">

@endif

<x-form-field-horizontal for="nameInput" label="Username"> 
    <input id="nameInput" type="text" class="form-control {{ bsInputInvalid( $errors->has('name') ) }}" name="name" value="{{ old('name', $user->name) }}" autofocus required>
    <x-form-feedback error="name">Only alphanumeric characters, underscores and dots.</x-form-feedback>
</x-form-field-horizontal>

<x-form-field-horizontal for="emailInput" label="Email">
    <input id="emailInput" type="email" class="form-control {{ bsInputInvalid( $errors->has('email') ) }}" name="email" value="{{ old('email', $user->email) }}" required>
    <x-form-feedback error="email">Credential to authenticate in the application</x-form-feedback>
</x-form-field-horizontal>

<x-form-field-horizontal for="passwordInput" label="Password" label-class="{{ $user->id ? 'form-label-optional' : '' }}">
    <input id="passwordInput" type="password" class="form-control {{ bsInputInvalid( $errors->has('password') ) }}" name="password" <?= $fake ? 'required' : '' ?>>
    <x-form-feedback error="password">Minimum 8 characters</x-form-field-horizontal>
</x-form-field-horizontal>

<x-form-field-horizontal for="passwordConfirmationInput" label="Confirm password">
    <input id="passwordConfirmationInput" type="password" class="form-control {{ bsInputInvalid( $errors->has('confirm_password') ) }}" name="password_confirmation" <?= $fake ? 'required' : '' ?>>
    <x-form-feedback error="password_confirmation">Write the password again</x-form-feedback>
</x-form-field-horizontal>
