<x-card title="Information" class="h-100">
    <x-slot name="options">
        <a href="{{ route('clients.edit', $client) }}" class="btn btn-warning">
            <i class="bi bi-pencil-fill"></i>
        </a>
    </x-slot>
    
    <small class="text-secondary">Address</small>
    <address>
        {{ $client->street }}<br>
        {{ $client->city_name }}<br>
        {{ $client->state_name }},
        {{ $client->country_name }}<br>
        {{ $client->zip_code }}<br>
        {{ $client->district_code }}<br>
    </address>

    <x-small-label label="Contact">
        @include('clients.__.contact')
    </x-small-label>

    <x-small-label label="Notes">
        <span>{{ $client->notes }}</span>
    </x-small-label>

    <x-custom.small-label-hook-users :model="$client" />
</x-card>
