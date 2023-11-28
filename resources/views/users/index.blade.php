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
                <th class="text-nowrap">Name & email</th>
                <th>Profile</th>
                <th>Last session</th>
                <th></th>
            </tr>
        </x-slot>

        @foreach($users as $user)
        <tr>
            <td style="width:1%">
                <span data-bs-toggle="tooltip" data-bs-title="{{ ucfirst($user->status) }}">
                    <x-circle-off-on :switcher="$user->isActive()" />
                </span>
            </td>
            <td>
                <span class="d-block">{{ $user->name }}</span>
                <small>{{ $user->email }}</small>
            </td>
            <td class="text-capitalize">
                <span class="d-block">{{ $user->profile->meta_name  }}</span>
                <small>{{ $user->profile_alias }}</small>
            </td>
            <td>
                <span class="d-block">{{ $user->last_session_date_human }}</span>
                <small>{{ $user->last_session_time_human }}</small>
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
