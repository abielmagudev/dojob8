@extends('application')

@section('header')
<x-page-title>Members</x-page-title>
@endsection

@section('content')
<x-card title="{{ $members->total() }} members">
    @slot('options')
        <x-modal-trigger modal-id="modalMembersFilters">
            <i class="bi bi-funnel"></i>
        </x-modal-trigger>

        <a href="{{ route('members.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i>
        </a>
    @endslot

    <x-table class="align-middle">
        <x-slot name="thead">
            <tr>
                <th></th>
                <th>Full name</th>
                <th>Position</th>
                <th>Contact</th>
                <th></th>
            </tr>
        </x-slot>

        @if( $members->count() )
        @foreach($members as $member)
        <tr>
            <td style="width:1%">
                <x-tooltip title="{{ ucfirst($member->presence_status) }}">
                    <x-indicator-on-off :toggle="$member->isActive()" />
                </x-tooltip>
            </td>
            <td class="text-nowrap">{{ $member->full_name }}</td>
            <td class="text-nowrap">{{ $member->position }}</td>
            <td class="text-nowrap">
                <x-custom.information-contact-channels :channels="$member->contact_data->filter()" type="tooltip" item-class="d-inline-block small mx-2" />
            </td>
            <td class="text-end">
                <a href="{{ route('members.show', $member) }}" class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-eye-fill"></i>
                </a>
            </td>
        </tr>
        @endforeach
        @endif
    </x-table>
</x-card>
<br>

<div class="px-3">
    <x-pagination-simple-model :collection="$members" />
</div>

@include('members.index.modal-filtering')
@endsection
