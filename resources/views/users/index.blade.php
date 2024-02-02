@extends('application')

@section('header')
<x-page-title>Users</x-page-title>
@endsection

@section('content')
<x-card title="{{ $users->total() }} users">
    @slot('options')
    <x-modal-trigger modal-id="modalFilterUsers">
        <i class="bi bi-funnel"></i>
    </x-modal-trigger>
    @endslot

    @if( $users->count() )
    <x-table class="align-middle">
        <x-slot name="thead">
            <tr>
                <th></th>
                <th>Username</th>
                <th>Name</th>
                <th>Profile</th>
                <th class="text-nowrap">Last session</th>
                <th></th>
            </tr>
        </x-slot>

        @foreach($users as $user)
        <tr>
            <td class="text-center" style="width:1%">
                <x-tooltip title="{{ ucfirst($user->presence_status) }}">
                    <x-indicator-on-off :toggle="$user->isActive()" />
                </x-tooltip>
            </td>
            <td>{{ $user->name }}</td>
            <td class="text-capitalize text-nowrap">
                <span>{{ $user->profile->authenticated_name }}</span>
            </td>
            <td class="text-capitalize">{{ $user->profiled }}</td>
            <td class="text-nowrap">
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
