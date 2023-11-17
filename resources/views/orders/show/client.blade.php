<x-card title="Client" class="h-100">    
    <small class="text-secondary">Address</small>
    <p class="mb-0">{{ $order->client->street }}</p>
    <p>{{ $order->client->location_country_code }}, {{ $order->client->zip_code}}</p>

    <small class="text-secondary">Contact</small>
    <p class="mb-0">{{ $order->client->fullname }}</p>
    <p class="mb-0">{{ $order->client->contact_info_collection->only(['phone','mobile'])->filter()->implode(',') }}</p>
    <p class="mb-3">{{ $order->client->email }}</p>
    <p>
        <small>
            <em>{{ $order->client->notes }}</em>
        </small>
    </p>
</x-card>
