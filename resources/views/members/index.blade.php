@extends('application')

@section('header')
<x-header title="Members" />
@endsection

@section('content')
<x-card>
    <x-slot name="options">     
        <x-modal-trigger modal-id="modalMembersFilters">
            <i class="bi bi-funnel"></i>
        </x-modal-trigger>

        <x-custom.link-with-total total="{{ $members->count() }}" route="{{ route('members.create') }}" />
    </x-slot>

    <x-table class="align-middle">
        <x-slot name="thead">
            <tr>
                <th></th>
                <th>Full name</th>
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

@include('members.index.modal-member-filters')
@endsection
