@extends('application')

@section('header')
<x-page-title>My account</x-page-title>
@endsection

@section('content')
    <x-card title="Edit">
        <form action="{{ route('account.update') }}" method="post" autocomplete="off">
            @method('patch')
            @csrf

            <div class="mb-3">
                <label for="inputEmail" class="form-label">Email</label>
                <input id="inputEmail" type="email" class="form-control {{ bsInputInvalid( $errors->has('email') ) }}" name="email" value="{{ auth()->user()->email }}" required>
                <x-form-feedback error="email" />
            </div>
            <div class="mb-3">
                <label for="inputPassword" class="form-label">Password</label>
                <input id="inputPassword" type="password" class="form-control {{ bsInputInvalid( $errors->has('password') ) }}" name="password" placeholder="Ignore this field to keep the same password">
                <x-form-feedback error="password" />
            </div>
            <div class="mb-3">
                <label for="inputPasswordConfirmation" class="form-label">Confirm password</label>
                <input id="inputPasswordConfirmation" type="password" class="form-control {{ bsInputInvalid( $errors->has('password') ) }}" name="password_confirmation">
                <x-form-feedback error="password_confirmation" />
            </div>
            <br>

            <div class="text-end">
                <button class="btn btn-warning" type="submit">Update my account</button>
            </div>
        </form>
    </x-card>
@endsection
