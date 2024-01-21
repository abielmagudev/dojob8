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
        <x-custom.information-contact-channels :channels="$work_order->contractor->contact_data->filter()"/>
        @endif
    </x-small-title>
    
    <x-small-title title="Crew">
        <div>{{ $work_order->crew->name }}</div>
    </x-small-title>

    <x-small-title title="Workers">
        {!! $work_order->members->map(function($member){ return $member->full_name; })->implode('<br>') !!}
    </x-small-title>
</x-card>
