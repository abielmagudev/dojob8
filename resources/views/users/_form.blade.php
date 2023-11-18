@csrf
<x-custom.form-control-horizontal class="align-items-center">
    <x-slot name="label">
        <label for="nameInput" class="form-label">Name</label>
    </x-slot>
    
    <input id="nameInput" type="text" class="form-control {{ bsInputInvalid( $errors->has('name') ) }}" name="name" value="{{ old('name', $user->name) }}">
    <x-error name="name" />
</x-custom.form-control-horizontal>

<x-custom.form-control-horizontal class="align-items-center">
    <x-slot name="label">
        <label for="emailInput" class="form-label">Email</label>
    </x-slot>

    <input id="emailInput" type="email" class="form-control {{ bsInputInvalid( $errors->has('email') ) }}" name="email" value="{{ old('email', $user->email) }}">
    <x-error name="email" />
</x-custom.form-control-horizontal>

<x-custom.form-control-horizontal class="align-items-center">
    <x-slot name="label">
        <label for="passwordInput" class="form-label {{ $user->id ? 'form-label-optional' : '' }}">Password</label>
    </x-slot>

    <input id="passwordInput" type="password" class="form-control {{ bsInputInvalid( $errors->has('password') ) }}" name="password" @if( is_null($user->id) ) required @endif>
    <x-error name="password" />
</x-custom.form-control-horizontal>

<x-custom.form-control-horizontal class="align-items-center">
    <x-slot name="label">
        <label for="confirmPasswordInput" class="form-label">Confirm password</label>
    </x-slot>

    <input id="confirmPasswordInput" type="password" class="form-control {{ bsInputInvalid( $errors->has('confirm_password') ) }}" name="confirm_password" @if( is_null($user->id) ) required @endif>
    <x-error name="confirm_password" />
</x-custom.form-control-horizontal>
