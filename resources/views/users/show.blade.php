@extends('application')

@section('header')
<x-header title="{{ $user->name }}" :breadcrumbs="[
    'Back to users' => route('users.index'),
    'User' => null
]">
    <x-slot name="options">
        <x-paginate 
            :previous="$routes['previous']" 
            :next="$routes['next']" 
        />
    </x-slot>
</x-header>
@endsection

@section('content')
<x-card title="Information" class="h-100">
    <x-slot name="options">
        <a href="{{ route('users.edit', $user) }}" class="btn btn-warning">
            <i class="bi bi-pencil-fill"></i>
        </a>
    </x-slot>

    <p>
        @if( mt_rand(0,1) )
        <x-badge color="success" class="text-uppercase">Active</x-badge>
        
        @else
        <x-badge color="secondary" class="text-uppercase">Inactive</x-badge>

        @endif
    </p>

    <x-custom.p-label label="Email">
        {{ $user->email }}
    </x-custom.p-label>

    <x-custom.p-label label="Profile" class="text-capitalize">
        <span class="d-block">{{ $user->profile->meta_name }}</span>
        <span class="d-block">{{ $user->profile_alias }}</span>
    </x-custom.p-label>

    <x-custom.p-label label="Role" class="text-capitalize">
    </x-custom.p-label>

    <x-custom.p-label label="Last session">
        <span class="d-block">{{ $user->last_session_date_human }}</span>
        <span class="d-block">{{ $user->last_session_time_human }}</span>
        <span class="d-block text-capitalize">{{ $user->last_session_device }}</span>
    </x-custom.p-label>
</x-card>
@endsection
