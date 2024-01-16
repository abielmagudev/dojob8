<x-card title="Information">
    <x-slot name="options">
        <a href="{{ route('members.edit', $member) }}" class="btn btn-warning">
            <i class="bi bi-pencil-fill"></i>
        </a>
    </x-slot>

    <p>
        <x-indicator-on-off :toggle="$member->isActive()" />
        <span class="text-uppercase">{{ $member->active_text }}</span>
    </p>

    @if( $member->contact_data_collection->filter()->count() )      
    <x-small-title title="Contact">
        @include('members.__.contact')
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

    <x-custom.information-hook-users :model="$member" />
</x-card>
