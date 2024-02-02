@extends('application')

@section('header')
<x-breadcrumb :items="[
    'Users' => route('users.index'),
    'User'
]" />
<x-page-title>{{ $user->name }}</x-page-title>
@endsection

@section('content')
<x-card title="Information">
    <x-slot name="options">
        <a href="{{ route('users.edit', $user) }}" class="btn btn-warning">
            <i class="bi bi-pencil-fill"></i>
        </a>
    </x-slot>

    <p>
        <x-indicator-on-off :toggle="$user->isActive()" />
        <span class="text-capitalize">{{ $user->presence_status }}</span>
    </p>

    <x-small-title title="Profile">
        <span class="d-block">{{ $user->profile->authenticated_name }}</span>
        <span class="text-capitalize text-secondary">{{ $user->profiled }}</span>
    </x-small-title>

    <x-small-title title="Email">
        <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
    </x-small-title>

    <x-small-title title="Last session">
        <span class="d-block">{{ $user->last_session_date_human }}</span>
        <span class="d-block">{{ $user->last_session_time_human }}</span>
        <span class="d-block text-capitalize">{{ $user->last_session_device }}</span>
    </x-small-title>
</x-card>
@endsection
