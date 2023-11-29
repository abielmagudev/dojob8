<x-card title="Participants" class="h-100">
    <x-small-label label="Client">
        <span class="d-block">{{ $work_order->client->fullname }}</span>
        <span class="d-block">{{ $work_order->client->street }}</span>
        <span class="d-block">{{ $work_order->client->location_country_code }}, {{ $work_order->client->zip_code}}</span>
        <span class="d-block">{{ $work_order->client->contact_data_collection->only(['phone','mobile'])->filter()->implode(',') }}</span>
        <span class="d-block">{{ $work_order->client->email }}</span>
        <a href="{{ route('clients.show', $work_order->client) }}">See client</a>
    </x-small-label>

    <x-small-label label="Intermediary">
        @if( $work_order->hasIntermediary() )
        <div>{{ $work_order->intermediary->name }}</div>
        <a href="{{ route('intermediaries.show', $work_order->intermediary) }}">See intermediary</a>
        @endif
    </x-small-label>
    
    <x-small-label label="Crew">
        @if( $work_order->hasCrew() )
        <div>{{ $work_order->crew->name }}</div>
        <a href="{{ route('crews.show', $work_order->crew) }}">See crew</a>
        @endif
    </x-small-label>

    <x-small-label label="Operators">
        ...
    </x-small-label>
</x-card>
