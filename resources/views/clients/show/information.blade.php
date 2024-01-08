<x-card title="Information" class="h-100">
    <x-slot name="options">
        <a href="{{ route('clients.edit', $client) }}" class="btn btn-warning">
            <i class="bi bi-pencil-fill"></i>
        </a>
    </x-slot>
    
    <x-small-label label="Address">
        @include('clients.__.address', [
            'except' => ['full_name'],
        ])
    </x-small-label>

    <x-small-label label="Contact">
        @include('clients.__.contact')
    </x-small-label>

    <x-small-label label="Notes">
        <span>{{ $client->notes }}</span>
    </x-small-label>

    <x-custom.small-label-hook-users :model="$client" />
</x-card>
