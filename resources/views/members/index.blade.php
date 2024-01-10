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

        <span>{{ $members->count() }}</span>
        <a href="{{ route('members.create') }}" class="btn btn-primary">
            <b>+</b>
        </a>
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
                <x-tooltip title="{{ ucfirst($member->active_text) }}">
                    <x-indicator-on-off :toggle="$member->isActive()" />
                </x-tooltip>
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

<x-pagination-simple-model :collection="$members" />

@include('members.index.modal-member-filters')
@endsection
