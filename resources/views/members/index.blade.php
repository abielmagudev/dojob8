@extends('application')

@section('header')
<x-header title="Staff">
    <x-slot name="options">
        <a href="{{ route('crews.index') }}" class="btn btn-primary">Crews</a>
    </x-slot>
</x-header>
@endsection

@section('content')
<x-card>
    <x-slot name="options">
        <a href="{{ route('members.create') }}" class="btn btn-primary">
            <b>+</b>
        </a>
    </x-slot>

    <x-table class="align-middle">
        <x-slot name="thead">
            <tr>
                <th></th>
                <th>Name</th>
                <th>Phone</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Role</th>
                <th></th>
            </tr>
        </x-slot>

        @foreach($members as $member)
        <tr>
            <td style="width:1%">
                <span data-bs-toggle="tooltip" data-bs-title="{{ ucfirst($member->active_status) }}">
                    <x-custom.circle-off-on :switcher="$member->isActive()" />
                </span>
            </td>
            <td>{{ $member->fullname }}</td>
            <td>{{ $member->phone_number }}</td>
            <td>{{ $member->mobile_number }}</td>
            <td>{{ $member->email }}</td>
            <td></td>
            <td class="text-end">
                <a href="{{ route('members.show', $member) }}" class="btn btn-outline-primary">
                    <i class="bi bi-eye-fill"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </x-table>
</x-card>
<br>
<x-pagination-simple-eloquent :collection="$members" />
@endsection
