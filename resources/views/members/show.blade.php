@extends('application')
@section('header')
<x-breadcrumb :items="[
    'Members' => route('members.index'),
    'Member'
]" />
<x-page-title>{{ $member->full_name }}</x-page-title>
@endsection

@section('content')
<x-card title="Information">
    <x-slot name="options">
        <a href="{{ route('members.edit', $member) }}" class="btn btn-warning">
            <i class="bi bi-pencil-fill"></i>
        </a>
    </x-slot>

    <p>
        <x-indicator-on-off :toggle="$member->isAvailable()" />
        <span class="text-capitalize">{{ $member->presence_status }}</span>
    </p>

    @if( $member->contact_data->filter()->count() )      
    <x-small-title title="Contact">
        <x-custom.information-contact-channels :channels="$member->contact_data->filter()" />
    </x-small-title>
    @endif

    @if( $member->hasPosition() )      
    <x-small-title title="Position">
        <span class="d-block">{{ $member->position }}</span>
    </x-small-title>
    @endif

    <x-small-title title="Notes">
        <em>{{ $member->notes }}</em>
    </x-small-title>

    <x-small-title title="Crews">
        @foreach($member->crews as $crew)
        @include('crews.__.flag', ['crew' => $crew])
        @endforeach
    </x-small-title>
    
    <x-custom.information-hook-users :model="$member" />
</x-card>
@endsection
