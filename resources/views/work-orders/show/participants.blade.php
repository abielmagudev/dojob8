<x-card title="Participants" class="h-100">
    <x-small-label label="Client">
        @include('clients.__.address',[
            'client' => $work_order->client,
        ])
    </x-small-label>

    <x-small-label label="Intermediary">
        @if( $work_order->hasIntermediary() )
        <div>{{ $work_order->intermediary->name }}</div>
        @endif
    </x-small-label>
    
    <x-small-label label="Crew">
        @if( $work_order->hasCrew() )
        <div>{{ $work_order->crew->name }}</div>
        @endif
    </x-small-label>

    <x-small-label label="Operators">
        ...
    </x-small-label>
</x-card>
