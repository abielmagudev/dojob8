@extends('application')

@section('header')
<x-page-title>Users</x-page-title>
@endsection

@section('content')
<x-card>
    <x-slot name="title">
        <span class="badge bg-dark">{{ $users->total() }}</span>
    </x-slot>

    <x-slot name="options">
        <x-modal-trigger modal-id="modalFilterUsers" class="btn btn-outline-primary">
            <i class="bi bi-filter"></i>
        </x-modal-trigger>
    </x-slot>

    @if( $users->count() )
    <x-table class="align-middle">
        <x-slot name="thead">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Profile</th>
                <th>Roles</th>
                <th class="text-nowrap">Last session</th>
                <th></th>
            </tr>
        </x-slot>

        @foreach($users as $user)
        <tr>
            <td>
                {{ $user->name }}
            </td>
            <td>
                {{ $user->email }}
            </td>
            <td class="text-capitalize text-nowrap">
                <span>{{ $user->profile_name }}</span>
                <em class="text-secondary">{{ $user->profile_short }}</em>
            </td>
            <td class="text-capitalize">
                {{ $user->getRoleNames()->implode(',') }}
            </td>
            <td class="text-nowrap <?= $user->isInactive() ? 'text-secondary' : '' ?>">
                <span class="me-1">{{ $user->last_session_date_human }}</span>
                <span>{{ $user->last_session_time_human }}</span>
            </td>
            <td class="text-end">
                <a href="{{ route('users.show', $user) }}" class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-eye-fill"></i>
                </a>
            </td>
        </tr>
        @endforeach

    </x-table>
    @endif
</x-card>
<br>

<div class="px-3">
    <x-pagination-simple-model :collection="$users" />
</div>

@include('users.index.modal-filtering')
@endsection
