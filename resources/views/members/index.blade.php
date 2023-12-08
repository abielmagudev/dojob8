@extends('application')

@section('header')
<x-header title="Members">
    @slot('subtitle')
    <small class="align-middle badge text-bg-dark">{{ $members->total() }}</small>
    @endslot
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
                <th>Contact</th>
                <th></th>
            </tr>
        </x-slot>

        @foreach($members as $member)
        <tr>
            <td style="width:1%">
                <span data-bs-toggle="tooltip" data-bs-title="{{ ucfirst($member->active_status) }}">
                    <x-circle-off-on :switcher="$member->isActive()" />
                </span>
            </td>
            <td>{{ $member->full_name }}</td>
            <td>
                @include('members.__.contact-table-cell')
            </td>
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
