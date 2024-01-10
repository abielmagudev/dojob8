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
        {{ $client->district_code }}
    </address>

    <p>
        <span>{{ $client->phone_number }}</span><br>
        <span>{{ $client->mobile_number }}</span><br>
        <span>{{ $client->email }}</span><br>
    </p>

    <p>{{ $client->notes }}</p>

    <x-custom.content-hook-users :model="$client" />
</x-card>
