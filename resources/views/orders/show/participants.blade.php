<x-card title="Participants" class="h-100">
    <x-custom.p-label label="Client">
        <span class="d-block">{{ $order->client->fullname }}</span>
        <span class="d-block">{{ $order->client->street }}</span>
        <span class="d-block">{{ $order->client->location_country_code }}, {{ $order->client->zip_code}}</span>
        <span class="d-block">{{ $order->client->contact_info_collection->only(['phone','mobile'])->filter()->implode(',') }}</span>
        <span class="d-block">{{ $order->client->email }}</span>
    </x-custom.p-label>

    <x-custom.p-label label="Intermediary">
        Road Runner (RR)
    </x-custom.p-label>
    
    <x-custom.p-label label="Crew">
        Sharks
    </x-custom.p-label>

    <x-custom.p-label label="Operators">
        Pedro, Pancho, Paco
    </x-custom.p-label>
</x-card>
