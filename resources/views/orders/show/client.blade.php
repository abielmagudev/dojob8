<x-card title="Client" class="h-100">    
    <x-custom.p-label label="Address">
        <span class="d-block">{{ $order->client->street }}</span>
        <span class="d-block">{{ $order->client->location_country_code }}, {{ $order->client->zip_code}}</span>
    </x-custom.p-label>

    <x-custom.p-label label="Contact">
        <span class="d-block">{{ $order->client->fullname }}</span>
        <span class="d-block">{{ $order->client->contact_info_collection->only(['phone','mobile'])->filter()->implode(',') }}</span>
        <span class="d-block">{{ $order->client->email }}</span>
    </x-custom.p-label>

    <x-custom.p-label label="Notes">
        <em class="d-block">{{ $order->client->notes }}</em>
    </x-custom.p-label>
</x-card>
