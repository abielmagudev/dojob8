@extends('application')

@section('header')
<x-header :title="$member->fullname" :breadcrumbs="[
    'Back to staff' => route('members.index'),
    'Member' => null
]">
    <x-slot name="options">
        <x-paginate 
            :previous="$routes['previous']" 
            :next="$routes['next']" 
        />
    </x-slot>
</x-header>
@endsection

@section('content')
<x-card title="Information">
    <x-slot name="options">
        <a href="{{ route('members.edit', $member) }}" class="btn btn-warning">
            <i class="bi bi-pencil-fill"></i>
        </a>
    </x-slot>

    <p>
        <x-badge :color="$member->isActive() ? 'success' : 'secondary'" class="text-uppercase">{{ $member->active_status }}</x-badge>
    </p>

    <x-small-label label="Birthdate">
        {{ $member->birthdate_human }}
    </x-small-label>

    <x-small-label label="Contact">
        {!! $member->contact_collection->filter()->implode('<br>') !!}
    </x-small-label>

    <x-small-label label="Position">
        {{ $member->position }}
    </x-small-label>

    <x-small-label label="Category">
        {{ ucfirst($member->category) }}
    </x-small-label>

    <x-small-label label="Scope">
        {{ ucfirst($member->scope) }}
    </x-small-label>

    <x-small-label label="Notes">
        <em>{{ $member->notes }}</em>
    </x-small-label>

    <x-custom.small-label-hook-users :model="$member" />
</x-card>
@endsection
