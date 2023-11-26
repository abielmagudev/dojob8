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

    <x-custom.p-label label="Birthdate">
        {{ $member->birthdate_human }}
    </x-custom.p-label>

    <x-custom.p-label label="Contact">
        {!! $member->contact_collection->filter()->implode('<br>') !!}
    </x-custom.p-label>

    <x-custom.p-label label="Position">
        {{ $member->position }}
    </x-custom.p-label>

    <x-custom.p-label label="Category">
        {{ ucfirst($member->category) }}
    </x-custom.p-label>

    <x-custom.p-label label="Scope">
        {{ ucfirst($member->scope) }}
    </x-custom.p-label>

    <x-custom.p-label label="Notes">
        <em>{{ $member->notes }}</em>
    </x-custom.p-label>

    <x-custom.p-label-modifiers :model="$member" />
</x-card>
@endsection
