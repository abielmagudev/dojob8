<x-card>
    <x-small-title title="Client">
        @include('clients.__.address',[
            'client' => $work_order->client,
        ])
    </x-small-title>

    <x-small-title title="Contractor">
        @if( $work_order->hasContractor() )
        @include('contractors.__.address', [
            'contractor' => $work_order->contractor,
        ])
        @include('contractors.__.contact', [
            'contractor' => $work_order->contractor,
            'except' => ['name_alias'],
        ])
        @endif
    </x-small-title>
    
    <x-small-title title="Crew">
        @if( $work_order->hasCrew() )
        <div>{{ $work_order->crew->name }}</div>
        @endif
    </x-small-title>

    <x-small-title title="Workers">
        {!! $work_order->members->map(function($member){ return $member->full_name; })->implode('<br>') !!}
    </x-small-title>
</x-card>
