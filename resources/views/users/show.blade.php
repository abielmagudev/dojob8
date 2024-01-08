@extends('application')

@section('header')
<x-header title="{{ $user->name }}" :breadcrumbs="[
    'Back to users' => route('users.index'),
    'User' => null
]" />
@endsection

@section('content')
<x-card title="Information" class="h-100">
    <x-slot name="options">
        <a href="{{ route('users.edit', $user) }}" class="btn btn-warning">
            <i class="bi bi-pencil-fill"></i>
        </a>
    </x-slot>

    <p>
        <x-badge :color="$user->isActive() ? 'success' : 'secondary'" class="text-uppercase">Active</x-badge>
    </p>

    <x-small-label label="Profile">
        <span class="d-block">{{ $user->profile->meta_name }}</span>
        <span class="d-block text-capitalize text-secondary">{{ $user->profile_alias }}</span>
    </x-small-label>

    <x-small-label label="Email">
        {{ $user->email }}
    </x-small-label>

    <x-small-label label="Last session">
        <span class="d-block">{{ $user->last_session_date_human }}</span>
        <span class="d-block">{{ $user->last_session_time_human }}</span>
        <span class="d-block text-capitalize">{{ $user->last_session_device }}</span>
    </x-small-label>
</x-card>
@endsection
