@extends('application')

@section('header')
<x-header title="Users" :breadcrumbs="[
    'Back to users' => route('users.index'),
    'Create' => null
]" />
@endsection

@section('content')
<x-card title="New user">
    <form action="{{ route('users.store') }}" method="post" autocomplete="off">
        @include('users._form')
        <br>
        <div class="text-end">
            <button class="btn btn-success" type="submit">Save user</button>
            <a href="{{ route('users.index') }}" class="btn btn-primary">Cancel</a>
        </div>
    </form>
</x-card>    
@endsection
