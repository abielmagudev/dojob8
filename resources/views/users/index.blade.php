@extends('application')

@section('header')
<x-header title="Users" />
@endsection

@section('content')
<x-card>
    <x-slot name="options">
        <a href="{{ route('users.create') }}" class="btn btn-primary">
            <b>+</b>
        </a>
    </x-slot>

    <x-table class="align-middle">
        <x-slot name="thead">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th></th>
            </tr>
        </x-slot>

        @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td class="text-end">
                <a href="{{ route('users.edit', $user) }}" class="btn btn-outline-warning">
                    <i class="bi bi-pencil-fill"></i>
                </a>
                <a href="{{ route('users.show', $user) }}" class="btn btn-outline-primary">
                    <i class="bi bi-eye-fill"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </x-table>
</x-card>
<br>
<x-pagination-simple :collection="$users" />
@endsection
