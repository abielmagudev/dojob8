@extends('application')

@section('header')
<x-header :title="$member->fullname" :breadcrumbs="[
    'Back to staff' => route('members.index'),
    'Member' => null
]" />
@endsection

@section('content')
<div class="row">
    <div class="col-md col-md-4">
        <x-card title="Information">
            <x-slot name="options">
                <a href="{{ route('members.edit', $member) }}" class="btn btn-warning">
                    <i class="bi bi-pencil-fill"></i>
                </a>
            </x-slot>

            <p>
                <x-badge :color="$member->isActive() ? 'success' : 'dark'" class="text-uppercase">{{ $member->isActive() ? 'Active' : 'Inactive' }}</x-badge>
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
    </div>
    <div class="col-md col-md-8">
        <x-card title="Log">
            
        </x-card>
    </div>
</div>
@endsection
