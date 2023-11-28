<x-card title="Participants" class="h-100">
    <x-small-label label="Client">
        <span class="d-block">{{ $work_order->client->fullname }}</span>
        <span class="d-block">{{ $work_order->client->street }}</span>
        <span class="d-block">{{ $work_order->client->location_country_code }}, {{ $work_order->client->zip_code}}</span>
        <span class="d-block">{{ $work_order->client->contact_data_collection->only(['phone','mobile'])->filter()->implode(',') }}</span>
        <span class="d-block">{{ $work_order->client->email }}</span>
    </x-small-label>

    <x-small-label label="Intermediary">
        Road Runner (RR)
    </x-small-label>
    
    <x-small-label label="Crew">
        Sharks
    </x-small-label>

    <x-small-label label="Operators">
        Pedro, Pancho, Paco
    </x-small-label>
</x-card>
