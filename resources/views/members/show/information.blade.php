<x-card title="Information">
    <x-slot name="options">
        <a href="{{ route('members.edit', $member) }}" class="btn btn-warning">
            <i class="bi bi-pencil-fill"></i>
        </a>
    </x-slot>

    <p>
        <x-badge :color="$member->isActive() ? 'success' : 'secondary'" class="text-uppercase">{{ $member->active_status }}</x-badge>
    </p>

    @if( $member->contact_data_collection->filter()->count() )      
    <x-small-label label="Contact">
        @include('members.__.contact')
    </x-small-label>
    @endif

    @if( $member->hasPosition() )      
    <x-small-label label="Position">
        <span class="d-block">{{ $member->position }}</span>
    </x-small-label>
    @endif

    @if( $member->hasBirthdate() )      
    <x-small-label label="Birthdate">
        {{ $member->birthdate_human }}
    </x-small-label>
    @endif

    @if( $member->hasNotes() )      
    <x-small-label label="Notes">
        <em>{{ $member->notes }}</em>
    </x-small-label>
    @endif

    <x-custom.small-label-hook-users :model="$member" />
</x-card>
