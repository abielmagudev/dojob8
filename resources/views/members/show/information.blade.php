<x-card title="Information">
    <x-slot name="options">
        <a href="{{ route('members.edit', $member) }}" class="btn btn-warning">
            <i class="bi bi-pencil-fill"></i>
        </a>
    </x-slot>

    <p>
        <x-badge :color="$member->isActive() ? 'success' : 'secondary'" class="text-uppercase">{{ $member->active_status }}</x-badge>
    </p>

    <x-small-label label="Contact">
        @include('members.__.contact')
    </x-small-label>

    <x-small-label label="Position">
        <span class="d-block">{{ ucfirst($member->category) }}</span>
        <span class="d-block">{{ $member->position }}</span>
        <span class="d-block">{{ ucfirst($member->scope) }}</span>
    </x-small-label>

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
