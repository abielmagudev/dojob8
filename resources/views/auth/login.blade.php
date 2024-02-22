@extends('application')
@section('content')
<div class="row justify-content-center align-items-center vh-100" data-bs-theme="light">
    <div class="col-sm col-sm-4">
        <div class="shadow rounded text-bg-light">
            <div class="text-bg-primary rounded-top py-4 px-3">
                <b class="fs-3">Welcome</b>
            </div>
            <div class="p-5">
                <form action="{{ route('login') }}" method="post" autocomplete="off">
                    @csrf
                    <div class="mb-3">
                        <label for="inputEmail" class="form-label">Email</label>
                        <input id="inputEmail" class="form-control" type="text" name="email" value="{{ old('email') }}" autofocus>
                        <x-form-feedback error="email" />
                    </div>
                    <div class="mb-3">
                        <label for="inputPassword" class="form-label">Password</label>
                        <input id="inputPassword" class="form-control" type="password" name="password">
                    </div>
                    <button class="btn btn-primary" type="submit">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
