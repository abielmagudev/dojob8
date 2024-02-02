@extends('application')

@section('header')
<x-breadcrumb :items="[
    'Users' => route('users.index'),
    'Create'
]" />
<x-page-title>{{ $user->name }}</x-page-title>
@endsection

@section('content')
<x-card title="New user">
    <form action="{{ route('users.store', $request->query()) }}" method="post" autocomplete="off">
        @csrf
        @include('users._form')
        <br>
        
        <div class="text-end">
            <button class="btn btn-success" type="submit">Create user</button>
            <a href="{{ route('users.index') }}" class="btn btn-primary">Cancel</a>
        </div>
    </form>
</x-card>    
@endsection
