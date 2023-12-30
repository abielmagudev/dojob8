<x-card>
    <x-small-label label="Client">
        @include('clients.__.address',[
            'client' => $work_order->client,
        ])
    </x-small-label>

    <x-small-label label="Contractor">
        @if( $work_order->hasContractor() )
        @include('contractors.__.address', [
            'contractor' => $work_order->contractor,
        ])
        @include('contractors.__.contact', [
            'contractor' => $work_order->contractor,
            'except' => ['name_alias'],
        ])
        @endif
    </x-small-label>
    
    <x-small-label label="Crew">
        @if( $work_order->hasCrew() )
        <div>{{ $work_order->crew->name }}</div>
        @endif
    </x-small-label>

    <x-small-label label="Workers">
        {!! $work_order->workers->map(function($member){ return $member->full_name; })->implode('<br>') !!}
    </x-small-label>
</x-card>
