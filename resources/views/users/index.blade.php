@extends('application')

@section('header')
<x-header title="Users" />
@endsection

@section('content')
<x-card>
    <x-table class="align-middle">
        <x-slot name="thead">
            <tr>
                <th></th>
                <th>Username</th>
                <th>Profile</th>
                <th class="text-nowrap">Last session</th>
                <th></th>
            </tr>
        </x-slot>

        @foreach($users as $user)
        <tr>
            <td style="width:1%">
                <x-tooltip title="{{ ucfirst($user->status) }}">
                    <x-circle-off-on :switcher="$user->isActive()" />
                </x-tooltip>
            </td>
            <td>{{ $user->name }}</td>
            <td class="text-capitalize">{{ $user->profile->meta_name  }} - <em class="text-secondary">{{ $user->profile_alias }}</em></td>
            <td>
                <span class="me-1">{{ $user->last_session_date_human }}</span>
                <span>{{ $user->last_session_time_human }}</span>
            </td>
            <td class="text-end">
                <a href="{{ route('users.show', $user) }}" class="btn btn-outline-primary">
                    <i class="bi bi-eye-fill"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </x-table>
</x-card>
<br>
<x-pagination-simple-eloquent :collection="$users" />
@endsection
