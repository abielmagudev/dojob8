<x-card title="Information" class="h-100">
    <x-slot name="options">
        <a href="{{ route('clients.edit', $client) }}" class="btn btn-warning">
            <i class="bi bi-pencil-fill"></i>
        </a>
    </x-slot>
    
    <x-small-title title="Address">
        @include('clients.__.address')
    </x-small-title>

    <x-small-title title="Contact">
        <x-custom.information-contact-channels :channels="$client->contact_data->filter()" />
    </x-small-title>

    <x-small-title title="Notes">
        {{ $client->notes }}
    </x-small-title>

    <x-custom.content-hook-users :model="$client" />
</x-card>
