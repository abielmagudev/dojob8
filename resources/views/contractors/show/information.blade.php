<x-card title="Information">
    @slot('options')
    <a href="{{ route('contractors.edit', $contractor) }}" class="btn btn-warning">
        <i class="bi bi-pencil-fill"></i>
    </a>
    @endslot

    <p>
        <x-indicator-on-off :toggle="$contractor->isAvailable()" />
        <span class="text-capitalize">{{ $contractor->presence_status }}</span>
    </p>

    <x-small-title title="Address">
        @include('contractors.__.address')
    </x-small-title>

    <x-small-title title="Contact">
        <x-custom.information-contact-channels :channels="$contractor->contact_data->filter()" />
    </x-small-title>

    <x-small-title title="Notes">
        {{ $contractor->notes }}
    </x-small-title>

    <x-custom.content-hook-users :model="$contractor" />
</x-card>
