@extends('application')

@section('header')
<x-breadcrumb :items="[
    'Users' => route('users.index'),
    'Create'
]" />
<x-page-title subtitle="{{ ucfirst($profile->profile_short) }}">{{ $profile->profile_name }}</x-page-title>
@endsection

@section('content')
@dump($errors->all())
<x-card title="New user">
    <form action="{{ route('users.store', [$request->profile => $request->profile_id]) }}" method="post" autocomplete="off">
        @csrf
        @include('users.includes.form')
        <input type="hidden" name="profile" value="{{ json_encode([$request->profile_short => $request->profile_id]) }}">
        <br>
        
        <div class="d-flex gap-2 justify-content-end align-items-center ">
            <a href="{{ $url_back }}" class="btn btn-outline-primary">Cancel</a>
            <button class="btn btn-success" type="submit">Create user</button>
        </div>
    </form>
</x-card>    
@endsection
