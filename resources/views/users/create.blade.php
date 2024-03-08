@extends('application')

@section('header')
<x-breadcrumb :items="[
    'Users' => route('users.index'),
    'Create'
]" />
<x-page-title>{{ $profile->profiled_name }}</x-page-title>
@endsection

@section('content')
<x-card title="New user">
    <form action="{{ route('users.store', [$request->profile => $request->profile_id]) }}" method="post" autocomplete="off">
        @csrf
        @includeWhen($request->profile_short == 'member', 'users.includes.form-member-roles')
        @include('users.includes.form')
        <input type="hidden" name="profile" value="{{ json_encode([$request->profile_short => $request->profile_id]) }}">
        <br>
        
        <div class="d-flex gap-2 justify-content-end align-items-center ">
            <a href="{{ route('users.index') }}" class="btn btn-outline-primary">Cancel</a>
            <button class="btn btn-success" type="submit">Create user</button>
        </div>
    </form>
</x-card>    
@endsection
